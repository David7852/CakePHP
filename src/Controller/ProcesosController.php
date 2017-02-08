<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\JcTable;
use PhpOffice\PhpWord\Style\Cell;
use PhpOffice\PhpWord\Style\Image;

/**
 * Procesos Controller
 *
 * @property \App\Model\Table\ProcesosTable $Procesos
 */
class ProcesosController extends AppController
{

    public function getRelated($id)
    {

        if($id==null)
            return null;
        $proceso = $this->Procesos->get($id, [
            'contain' => ['Trabajadores', 'Asignaciones', 'Devoluciones']
        ]);
        return $proceso;
    }

    public function solicitar()
    {
        $proceso = $this->Procesos->newEntity();
        if ($this->request->is('post')) {
            $proceso = $this->Procesos->patchEntity($proceso, $this->request->data);
            if ($this->Procesos->save($proceso)) {
                $this->Flash->success(__('La solicitud del proceso fue registrada.'));
                $p_t=TableRegistry::get('ProcesosTrabajadores')->newEntity();
                $p_t=TableRegistry::get('ProcesosTrabajadores')->patchEntity($p_t,
                    [
                        'trabajador_id'=>$this->request->session()->read('Auth.User.trabajador_id'),
                        'proceso_id'=>$proceso->id,
                        'rol'=>'Solicitante',
                    ]);
                if(!TableRegistry::get('ProcesosTrabajadores')->save($p_t))
                {
                    TableRegistry::get('Procesos')->delete($proceso);
                    $this->Flash->error('El intento de registrar la solicitud fallo.');
                }
                return $this->redirect(['action' => 'view',$proceso->id]);
            } else {
                $this->Flash->error(__('El proceso no pudo ser guardado. Intente nuevamente.'));
            }
        }
        $trabajadores = $this->Procesos->Trabajadores->find('list', ['limit' => 200]);
        $this->set(compact('proceso', 'trabajadores'));
        $this->set('_serialize', ['proceso']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {

        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $procesos=array();
            $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
                ->where(['trabajador_id ='=>$this->request->session()->read('Auth.User.trabajador_id')]);
            foreach ($pro_tra as $p)
                array_push($procesos,$p->proceso_id);
            if(empty($procesos)){
                $this->Flash->error(__('Usted no tiene Procesos ni solicitudes a su nombre.'));
                return $this->redirect($this->referer());
            }
            $procesos = $this->paginate($this->Procesos->find('all',array('conditions'=>array('Procesos.id IN'=>$procesos))));
        }else
            $procesos = $this->paginate($this->Procesos);
        $this->set(compact('procesos'));
        $this->set('_serialize', ['procesos']);
    }

    /**
     * View method
     *
     * @param string|null $id Proceso id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante'||$this->request->session()->read('Auth.User.funcion')=='Operador')
        {
            $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
                ->where(['proceso_id ='=>$id])
                ->andWhere(['trabajador_id ='=>$this->request->session()->read('Auth.User.trabajador_id')]);
            if($pro_tra==null||$pro_tra->isEmpty()){
                if($this->request->session()->read('Auth.User.funcion')=='Operador')
                    $this->Flash->error(__('Usted no esta asignado a este proceso y por tanto no puede verlo en detalle.'));
                else
                    $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
                return $this->redirect($this->referer());
            }
        }
        $proceso = $this->Procesos->get($id, [
            'contain' => ['Trabajadores', 'Asignaciones', 'Devoluciones']
        ]);

        $this->planilla();
        $this->set('proceso', $proceso);
        $this->set('_serialize', ['proceso']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante'||$this->request->session()->read('Auth.User.funcion')=='Operador') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
        $proceso = $this->Procesos->newEntity();
        if ($this->request->is('post')) {
            $proceso = $this->Procesos->patchEntity($proceso, $this->request->data);
            if ($this->request->data['solicitantes']!=null&&$this->Procesos->save($proceso))
            {
                $p_t=TableRegistry::get('ProcesosTrabajadores')->newEntity();
                $p_t=TableRegistry::get('ProcesosTrabajadores')->patchEntity($p_t,
                    [
                        'trabajador_id'=>$this->request->session()->read('Auth.User.trabajador_id'),
                        'proceso_id'=>$proceso->id,
                        'rol'=>'Supervisor',
                    ]);
                TableRegistry::get('ProcesosTrabajadores')->save($p_t);
                $p_t=TableRegistry::get('ProcesosTrabajadores')->newEntity();
                $p_t=TableRegistry::get('ProcesosTrabajadores')->patchEntity($p_t,
                    [
                        'trabajador_id'=>$this->request->data['solicitantes'],
                        'proceso_id'=>$proceso->id,
                        'rol'=>'Solicitante',
                    ]);
                TableRegistry::get('ProcesosTrabajadores')->save($p_t);
                $this->Flash->success(__('El proceso fue registrado.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El proceso no pudo ser guardado. Intente nuevamente.'));
            }
        }
        $trabajadores = $this->Procesos->Trabajadores->find('list')
            ->where(['gerencia =' => 'IT'])
            ->andWhere(['id !='=>$this->request->session()->read('Auth.User.trabajador_id')]);
        $solicitantes= $this->Procesos->Trabajadores->find('list', ['limit' => 200]);
        $this->set(compact('proceso', 'trabajadores', 'solicitantes'));
        $this->set('_serialize', ['proceso']);
    }

    public function asociarequipo()
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante'||$this->request->session()->read('Auth.User.funcion')=='Operador') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
        $proceso = $this->Procesos->newEntity();
        if ($this->request->is('post')) {
            $proceso = $this->Procesos->patchEntity($proceso, $this->request->data);
            if ($this->request->data['articulo_id']!=null&&$this->request->data['solicitantes']!=null&&$this->Procesos->save($proceso))
            {
                $p_t=TableRegistry::get('ProcesosTrabajadores')->newEntity();
                $p_t=TableRegistry::get('ProcesosTrabajadores')->patchEntity($p_t,
                    [
                        'trabajador_id'=>$this->request->session()->read('Auth.User.trabajador_id'),
                        'proceso_id'=>$proceso->id,
                        'rol'=>'Supervisor',
                    ]);
                TableRegistry::get('ProcesosTrabajadores')->save($p_t);
                $p_t=TableRegistry::get('ProcesosTrabajadores')->newEntity();
                $p_t=TableRegistry::get('ProcesosTrabajadores')->patchEntity($p_t,
                    [
                        'trabajador_id'=>$this->request->data['solicitantes'],
                        'proceso_id'=>$proceso->id,
                        'rol'=>'Solicitante',
                    ]);
                TableRegistry::get('ProcesosTrabajadores')->save($p_t);
                $asig=TableRegistry::get('Asignaciones')->newEntity();
                $asig=TableRegistry::get('Asignaciones')->patchEntity($asig,
                    [
                        'proceso_id'=>$proceso->id,
                        'articulo_id'=>$this->request->data['articulo_id'],
                        'hasta'=>$this->request->data['hasta']
                    ]
                    );
                TableRegistry::get('Asignaciones')->save($asig);
                $this->Flash->success(__('El proceso fue registrado.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El proceso no pudo ser guardado. Intente nuevamente.'));
            }
        }
        $solicitantes = $this->Procesos->Trabajadores->find('list')
            ->where(['id !='=>$this->request->session()->read('Auth.User.trabajador_id')]);
        $modelos=TableRegistry::get('Modelos')->find('all')
            ->where(['tipo_de_articulo =' =>'Celular'])
            ->orWhere(['tipo_de_articulo =' =>'Telefono'])
            ->orWhere(['tipo_de_articulo =' =>'Smartphone']);
        $articulos=array();
        foreach ($modelos as $modelo) {
            $art=TableRegistry::get('Articulos')->find('all')
            ->where(['modelo_id ='=>$modelo->id]);
                foreach ($art as $iculos) {
                    array_push($articulos,$iculos->id);
                }
        }
        if(!empty($articulos))
        $articulos = TableRegistry::get('Articulos')->find('list',array('conditions'=>array('Articulos.id IN'=>$articulos)));
        $this->set(compact('proceso', 'trabajadores', 'solicitantes','articulos'));
        $this->set('_serialize', ['proceso']);
    }
    public function devolverequipo()
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante'||$this->request->session()->read('Auth.User.funcion')=='Operador') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
        $proceso = $this->Procesos->newEntity();
        if ($this->request->is('post')) {
            $proceso = $this->Procesos->patchEntity($proceso, $this->request->data);
            if ($this->request->data['articulo_id']!=null&&$this->request->data['solicitantes']!=null&&$this->Procesos->save($proceso))
            {
                $p_t=TableRegistry::get('ProcesosTrabajadores')->newEntity();
                $p_t=TableRegistry::get('ProcesosTrabajadores')->patchEntity($p_t,
                    [
                        'trabajador_id'=>$this->request->session()->read('Auth.User.trabajador_id'),
                        'proceso_id'=>$proceso->id,
                        'rol'=>'Supervisor',
                    ]);
                TableRegistry::get('ProcesosTrabajadores')->save($p_t);
                $p_t=TableRegistry::get('ProcesosTrabajadores')->newEntity();
                $p_t=TableRegistry::get('ProcesosTrabajadores')->patchEntity($p_t,
                    [
                        'trabajador_id'=>$this->request->data['solicitantes'],
                        'proceso_id'=>$proceso->id,
                        'rol'=>'Solicitante',
                    ]);
                TableRegistry::get('ProcesosTrabajadores')->save($p_t);
                $asig=TableRegistry::get('Devoluciones')->newEntity();
                $asig=TableRegistry::get('Devoluciones')->patchEntity($asig,
                    [
                        'proceso_id'=>$proceso->id,
                        'articulo_id'=>$this->request->data['articulo_id'],
                    ]
                );
                TableRegistry::get('Devoluciones')->save($asig);

                $this->Flash->success(__('El proceso fue registrado.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El proceso no pudo ser guardado. Intente nuevamente.'));
            }
        }
        $solicitantes = $this->Procesos->Trabajadores->find('list')
            ->where(['id !='=>$this->request->session()->read('Auth.User.trabajador_id')]);
        $modelos=TableRegistry::get('Modelos')->find('all')
            ->where(['tipo_de_articulo =' =>'Celular'])
            ->orWhere(['tipo_de_articulo =' =>'Telefono'])
            ->orWhere(['tipo_de_articulo =' =>'Smartphone']);
        $articulos=array();
        foreach ($modelos as $modelo) {
            $art=TableRegistry::get('Articulos')->find('all')
                ->where(['modelo_id ='=>$modelo->id]);
            foreach ($art as $iculos) {
                array_push($articulos,$iculos->id);
            }
        }
        if(!empty($articulos))
            $articulos = TableRegistry::get('Articulos')->find('list',array('conditions'=>array('Articulos.id IN'=>$articulos)));
        $this->set(compact('proceso', 'trabajadores', 'solicitantes','articulos'));
        $this->set('_serialize', ['proceso']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Proceso id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante'||$this->request->session()->read('Auth.User.funcion')=='Operador') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }else
        {
            $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
                ->where(['proceso_id ='=>$id])
                ->andWhere(['trabajador_id =' => $this->request->session()->read('Auth.User.trabajador_id')])
                ->andWhere(['rol ='=>'Solicitante']);
            if($pro_tra!=null&&!$pro_tra->isEmpty()){
                $this->Flash->error(__('Usted es el solicitante de este proceso, por tanto no puede editarlo'));
                return $this->redirect($this->referer());
            }
            $super=TableRegistry::get('ProcesosTrabajadores')->find('all')
                ->where(['proceso_id ='=>$id])
                ->andWhere(['rol ='=>'Supervisor']);
            if(($super!=null&&!$super->isEmpty())&&$super->first()->trabajador_id!=$this->request->session()->read('Auth.User.trabajador_id')){
                $this->Flash->error(__('Usted no es el supervisor encargado de este proceso y por tanto no puede editarlo.'));
                return $this->redirect($this->referer());
            }
        }
        $proceso = $this->Procesos->get($id, [
            'contain' => ['Trabajadores']
        ]);
        $solicitantes=array();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $proceso = $this->Procesos->patchEntity($proceso, $this->request->data);
            if ($this->Procesos->save($proceso))
            {
                if($this->request->data['solicitantes']!=null&&!empty($this->request->data['solicitantes']))
                {
                    $pro_tra = TableRegistry::get('ProcesosTrabajadores')->newEntity();
                    $pro_tra = TableRegistry::get('ProcesosTrabajadores')->patchEntity($pro_tra,
                        [
                            'trabajador_id' => $this->request->data['solicitantes'],
                            'proceso_id' => $id,
                            'rol' => 'Solicitante',
                        ]);
                    TableRegistry::get('ProcesosTrabajadores')->save($pro_tra);
                }
                if($this->request->data['estado']!='Pendiente'||($super!=null&&!$super->isEmpty()))
                {
                    $pro_tra=TableRegistry::get('ProcesosTrabajadores')->newEntity();
                    $pro_tra=TableRegistry::get('ProcesosTrabajadores')->patchEntity($pro_tra,
                        [
                            'trabajador_id'=>$this->request->session()->read('Auth.User.trabajador_id'),
                            'proceso_id'=>$id,
                            'rol'=>'Supervisor',
                        ]);
                    TableRegistry::get('ProcesosTrabajadores')->save($pro_tra);
                }
                $this->Flash->success(__('Los cambios en el proceso fueron registrados.'));
                return $this->redirect(['action' => 'index']);
            } else
            {
                $this->Flash->error(__('Los cambios no pudieron guardarse. Intente nuevamente.'));
            }
        }
        $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
            ->where(['proceso_id ='=>$id])
            ->andWhere(['rol ='=>'Solicitante']);
        $s=array();
        foreach ($pro_tra as $pt) array_push($s,$pt->trabajador_id);
        if($pro_tra!=null&&!$pro_tra->isEmpty()&&!empty($s))
            $solicitantes=$this->Procesos->Trabajadores->find('list',array('conditions'=>array('Trabajadores.id IN'=>$s)));
        $trabajadores = $this->Procesos->Trabajadores->find('list')
            ->where(['gerencia =' => 'IT'])
            ->andWhere(['id !='=>$this->request->session()->read('Auth.User.trabajador_id')]);
        $this->set(compact('proceso', 'trabajadores', 'solicitantes'));
        $this->set('_serialize', ['proceso']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Proceso id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if($this->request->session()->read('Auth.User.funcion')!='Administrador'&&$this->request->session()->read('Auth.User.funcion')!='Superadministrador') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la accion solicitada.'));
            return $this->redirect($this->referer());
        }
        $this->request->allowMethod(['post', 'delete']);
        $proceso = $this->Procesos->get($id);
        if ($this->Procesos->delete($proceso)) {
            $this->Flash->success(__('El proceso fue eliminado.'));
        } else {
            $this->Flash->error(__('El Proceso no pudo eliminarse. Intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
//////Plantilla de asig/dev
//
public function planilla()
{
    if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
        $this->Flash->error(__('Usted no tiene permiso para realizar esta accion.'));
        return $this->redirect($this->referer());
    }
    $phpWord = new PHPWord();
    $sectionStyle=array('pageSizeH'=>Converter::cmToTwip(27.94),'pageSizeW'=>Converter::cmToTwip(21.59));
    $section = $phpWord->addSection($sectionStyle);
    $section->setStyle(array());
    $fancyTableStyle = array('borderSize' => 12, 'borderColor' => 'green');
    $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center', 'bgColor' => 'FFFFFF');
    $cellRowContinue = array('vMerge' => 'continue');
    $cellColSpan = array('cellMargin' => 80,'gridSpan' => 2, 'valign' => 'center');
    $cellHCentered = array('alignment' => Jc::CENTER);
    $cellVCentered = array('valign' => 'center');

    //header
    $spanTableStyleName = 'Colspan Rowspan';
    $phpWord->addTableStyle($spanTableStyleName, $fancyTableStyle);
    $table = $section->addTable($spanTableStyleName);
    $table->addRow();
   $table->addCell(2500, array('vMerge' => 'restart', 'bgColor' => 'FFFFFF'))->addImage('../webroot/img/fertinitrorif.png',array(
       'width'            => Converter::cmToPixel(3.42),
       'height'           => Converter::cmToPixel(2),
       'positioning'      => Image::POSITION_ABSOLUTE,
       'posHorizontal'    => Image::POSITION_HORIZONTAL_LEFT,
       'posHorizontalRel' => Image::POSITION_RELATIVE_TO_COLUMN,
       'posVertical'      => Image::POSITION_VERTICAL_TOP,
       'posVerticalRel'   => Image::POSITION_RELATIVE_TO_PAGE,
    ));
    $cell2 = $table->addCell(6500, array('cellMargin' => 80,'gridSpan' => 2, 'valign' => 'center'));
    $textrun2 = $cell2->addTextRun( array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1));
    $textrun2->addText('Fertilizantes Nitrogenados de Venezuela, FERTINITRO, C.E.C',array('name' => 'Arial Narrow','bold'=>true,'color'=>'green','size'=>'14'));
    $textrun2->addTextBreak(1,array('spacing' => 240, 'size' => 24));
    $textrun2->addText(' ');
    $textrun2->addTextBreak(1,array('spacing' => 240, 'size' => 24));
    $textrun2->addText('ASIGNACIÓN DE EQUIPOS DE INFORMÁTICA Y TELECOMUNICACIONES', array('name'=>'Arial','bold' => true,'color'=>'black', 'size'=>'10','valign' => 'center','line' => 24),$cellHCentered);
    $table->addCell(2000, $cellRowSpan)->addImage('../webroot/img/logoit.png',array(
        'positioning'      => Image::POSITION_RELATIVE,
        'posHorizontal'    => Image::POSITION_HORIZONTAL_CENTER,
        'posHorizontalRel' => Image::POSITION_RELATIVE_TO_COLUMN,
        'posVertical'      => Image::POSITION_VERTICAL_TOP,
        'posVerticalRel'   => Image::POSITION_RELATIVE_TO_LINE,
    'marginLeft'    => 1,
    'width'         => 88,
    'height'        => 70));
    $section->addTextBreak(1,array('spacing' => 240, 'size' => 1));
    // 5. Nested table indent solicitud
    $table = $section->addTable(array('borderSize' => 0, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER));
    $cell = $table->addRow()->addCell(11000, array('cellMargin' => 80, 'valign' => 'center','bgColor' => 'c0c0c0'));
    $textrun = $cell->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1));
    $textrun->addText('IDENTIFICACION DEL SOLICITANTE',array('lineHeight'=>0.1,'name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
    $cell = $table->addRow()->addCell(11000, array('bgColor' => 'ffffff'));
    $innert1  = $cell->addTable(array('alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER));
        $innerrow1=$innert1->addRow();
            $innercell11 =$innerrow1->addCell(3000, array('bgColor' => 'ffffff'))->addTextRun(array('spaceAfter' => 1,'size' => 8));
                $innercell11->addText('Nombre y Apellido:',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'right'));
                $innercell11->addText('???',array('name' => 'Arial', 'size'=>8, 'valign' => 'right'));
            $innercell12 =$innerrow1->addCell(3000, array('bgColor' => 'ffffff'))->addTextRun(array('spaceAfter' => 1,'size' => 8));
                $innercell12->addText('C.I.:',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'right'));
                $innercell12->addText('???',array('name' => 'Arial', 'size'=>8, 'valign' => 'right'));
            $innercell13 =$innerrow1->addCell(3000, array('bgColor' => 'ffffff'))->addTextRun(array('spaceAfter' => 1,'size' => 8));
                $innercell13->addText('Extensión:',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'right'));
                $innercell13->addText('???',array('name' => 'Arial', 'size'=>8, 'valign' => 'right'));
    $innert2 = $cell->addTable(array('alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER));
        $innerrow2=$innert2->addRow();
            $innercell21=$innerrow2->addCell(3000, array('bgColor' => 'ffffff'))->addTextRun(array('spaceAfter' => 1,'size' => 8));
                $innercell21->addText('Correo:',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'right'));
                $innercell21->addText('???',array('name' => 'Arial', 'size'=>8, 'valign' => 'right'));
            $innercell22=$innerrow2->addCell(3000, array('bgColor' => 'ffffff'))->addTextRun(array('spaceAfter' => 1,'size' => 8));
                $innercell22->addText('Supervisor:',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'right'));
                $innercell22->addText('???',array('name' => 'Arial', 'size'=>8, 'valign' => 'right'));
            $innercell23=$innerrow2->addCell(3000, array('bgColor' => 'ffffff'))->addTextRun(array('spaceAfter' => 1,'size' => 8));
                $innercell23->addText('Area:',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'right'));
                $innercell23->addText('???',array('name' => 'Arial', 'size'=>8, 'valign' => 'right'));
    $innert3 = $cell->addTable(array('alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER));
        $innerrow3=$innert3->addRow();
            $innercell31=$innerrow3->addCell(3000, array('bgColor' => 'ffffff'))->addTextRun(array('spaceAfter' => 1,'size' => 8));
                $innercell31->addText('Gerencia:',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'right'));
                $innercell31->addText('???',array('name' => 'Arial', 'size'=>8, 'valign' => 'right'));
            $innercell32=$innerrow3->addCell(3000, array('bgColor' => 'ffffff'))->addTextRun(array('spaceAfter' => 1,'size' => 8));
                $innercell32->addText('Cargo:',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'right'));
                $innercell32->addText('???',array('name' => 'Arial', 'size'=>8, 'valign' => 'right'));
            $innercell33=$innerrow3->addCell(3000, array('bgColor' => 'ffffff'))->addTextRun(array('spaceAfter' => 1,'size' => 8));
                $innercell33->addText('Ubicación:',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'right'));
                $innercell33->addText('???',array('name' => 'Arial', 'size'=>8, 'valign' => 'right'));
    $section->addTextBreak(1,array('spacing' => 240, 'size' => 1));

    $table = $section->addTable(array('borderSize' => 0, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER));
    $cell = $table->addRow()->addCell(11000, array('gridSpan' => 7,'valign' => 'center','bgColor' => 'c0c0c0'));
    $textrun = $cell->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1));
    $textrun->addText('EQUIPOS ASIGNADOS',array('lineHeight'=>0.1,'name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
    $row = $table->addRow();
    $row->addCell(1800, ['vMerge' => 'restart','borderSize'=>0])->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 2))->addText('Tipo de Equipo',array('valign' => 'center'));
    $row->addCell(1200, ['vMerge' => 'restart','borderSize'=>0])->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 2))->addText('Accesorios',array('valign' => 'center'));
    $row->addCell(1800, ['gridSpan' => 2, 'vMerge' => 'restart','borderSize'=>0])->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 2))->addText('Asignación',array('valign' => 'center'));
    $row->addCell(5200, ['gridSpan' => 3, 'vMerge' => 'restart','borderSize'=>0])->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 2))->addText('Identificación del equipo',array('valign' => 'center'));
    $row = $table->addRow();
    $row->addCell(null, ['vMerge' => 'continue','borderSize'=>0]);
    $row->addCell(null, ['vMerge' => 'continue','borderSize'=>0]);
    $row->addCell(900,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('Desde',array('valign' => 'center'));
    $row->addCell(900,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('hasta',array('valign' => 'center'));
    $row->addCell(1100,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('Marca',array('valign' => 'center'));
    $row->addCell(2100,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('Modelo',array('valign' => 'center'));
    $row->addCell(3000,array('borderSize'=>0))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('Serial',array('valign' => 'center'));
    $items=4;
    for ($i = 0;$i < $items; $i++)
    {
        $row = $table->addRow();
        $row->addCell(1800,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('???',array('valign' => 'center'));
        $row->addCell(1200,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('???',array('valign' => 'center'));
        $row->addCell(900,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('???',array('valign' => 'center'));
        $row->addCell(900,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('???',array('valign' => 'center'));
        $row->addCell(1100,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('???',array('valign' => 'center'));
        $row->addCell(2100,array('borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('???',array('valign' => 'center'));
        $row->addCell(3000,array('borderSize'=>0))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('???',array('valign' => 'center'));
    }
    $cell = $table->addRow()->addCell(9000, array('gridSpan' => 7,'bgColor' => 'ffffff'));
    $cell->addTextRun(array('spaceAfter' => 0,'size' => 1))->addText('Observaciones:',array('valign' => 'right'));
    $cell->addTextRun(array('spaceAfter' => 0,'size' => 1))->addText('???',array('valign' => 'right'));
    $cell->addTextRun(array('spaceAfter' => 0,'size' => 1))->addText('',array('valign' => 'right'));
    $row = $table->addRow();
    $row->addCell(9000,array('valign' => 'center','bgColor' => 'c0c0c0','gridSpan' => 7,'borderSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 0,'size' => 1))->addText('CONDICIONES GENERALES DE LA ASIGNACION',array('lineHeight'=>0.1,'name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'center'));
    $row = $table->addRow();
    $text = $row->addCell(9000,array('spaceAfter' => 0,'size' => 1,'gridSpan' => 7,'borderSize'=>3));
    $multilevelNumberingStyleName = 'multilevel';
    $phpWord->addNumberingStyle(
        $multilevelNumberingStyleName,
        array(
            'type'   => 'multilevel',
            'levels' => array(
                array('format' => 'decimal', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360),
                array('format' => 'upperLetter', 'text' => '%2.', 'left' => 720, 'hanging' => 360, 'tabPos' => 720),
            ),
        )
    );
    $paragraphStyleName = 'P-Style';
    $phpWord->addParagraphStyle($paragraphStyleName, array('spaceAfter' => 5));
    $text->addTextRun(array('spaceAfter' => 0,'size' => 1))->addText('El solicitante declara:',array('valign' => 'right'));
    $text->addListItem('Que ha recibido de FERTINITRO, en calidad de préstamo y  por tiempo determinado, los equipos arriba descritos de su propiedad, en el entendido que los mismos serán utilizados en asuntos de trabajo relacionado con labores de la Empresa.',
        0,array('spaceAfter' => 0,'size' => 1,'name' => 'Arial', 'size'=>8, 'valign' => 'right'), $multilevelNumberingStyleName, $paragraphStyleName);
    $text->addListItem('Conocer que conforme a lo dispuesto en el artículo 102 de la Ley Orgánica del trabajo literal G, constituyen causal justificada de despido: el perjuicio material causado intencionalmente o con negligencia grave en las máquinas, herramientas y útiles de trabajo y mobiliario de la empresa.',
        0, array('spaceAfter' => 0,'size' => 1,'name' => 'Arial', 'size'=>8, 'valign' => 'right'), $multilevelNumberingStyleName, $paragraphStyleName);
    $text->addListItem('Conocer las normas de Protección de Activos de Información (PAI).',
        0, array('spaceAfter' => 0,'size' => 1,'name' => 'Arial', 'size'=>8, 'valign' => 'right'), $multilevelNumberingStyleName, $paragraphStyleName);
    $text->addListItem('Ser responsable por cualquier daño, robo o pérdida de los equipos causado o derivado de hechos o actuaciones intencionales o con negligencia y se compromete a restituirlo, pagando su costo de reposición.',
        0, array('spaceAfter' => 0,'size' => 1,'name' => 'Arial', 'size'=>8, 'valign' => 'right'), $multilevelNumberingStyleName, $paragraphStyleName);
    $text->addListItem('Que en caso de daño, robo o perdida de los equipos hará un Reporte de Pérdida de Propiedad (RPP) de los equipos y lo presentará a Prevención y Control de Pérdida (PCP) el primer día hábil siguiente. En caso de robo o pérdida deberá anexar la denuncia realizada en la Cuerpo de Investigaciones Científicas, Penales y criminalistas (CICPC).',
        0, array('spaceAfter' => 0,'size' => 1,'name' => 'Arial', 'size'=>8, 'valign' => 'right'), $multilevelNumberingStyleName, $paragraphStyleName);
    $text->addListItem('Que está autorizado a sacar del edificio los equipos portátiles que tengan el debido  carnet de identificación. Queda terminantemente prohibido que los equipos pertenecientes a la Empresa, se intercambien o presten a terceros.',
        0, array('spaceAfter' => 0,'size' => 1,'name' => 'Arial', 'size'=>8, 'valign' => 'right'), $multilevelNumberingStyleName, $paragraphStyleName);
    $text->addListItem('Que está consciente que los equipos forman parte de la infraestructura de tecnología de información de FERTINITRO y se compromete a salvaguardarlos con la debida diligencia. Se compromete a devolver  los equipos en las mismas condiciones operativas en las cuales les fueron entregados.',
        0, array('spaceAfter' => 0,'size' => 1,'name' => 'Arial', 'size'=>8, 'valign' => 'right'), $multilevelNumberingStyleName, $paragraphStyleName);
    $text->addListItem('Que no hará reproducción parcial o total del "software" existente en los equipos suministrados, ni instalará "software" adicional en el mismo, dando cumplimiento a lo establecido en la Norma PAI.',
        0, array('spaceAfter' => 0,'size' => 1,'name' => 'Arial', 'size'=>8, 'valign' => 'right'), $multilevelNumberingStyleName, $paragraphStyleName);
    $cell = $table->addRow()->addCell(9000, array('gridSpan' => 7,'vMerge' => 'restart','bgColor' => 'ffffff'));

    $innert0 = $cell->addTable(array('alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER));
    $innerrow0=$innert0->addRow();
    $innercell01 =$innerrow0->addCell(3000, array('bgColor' => 'ffffff'))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 1,'size' => 8));
    $innercell01->addText('CONTROL DE ACTIVOS',array('name' => 'Arial','bold'=>true, 'size'=>8, 'valign' => 'center'));
    $innercell02 =$innerrow0->addCell(3000, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 1,'size' => 8));
    $innercell02->addText('SOPORTE Y ATENCION USUARIOS',array('name' => 'Arial','bold'=>true, 'size'=>8, 'valign' => 'center'));
    $innercell03 =$innerrow0->addCell(3000, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('alignment' => Jc::CENTER,'spaceAfter' => 1,'size' => 8));
    $innercell03->addText('SOLICITANTE:',array('name' => 'Arial','bold'=>true, 'size'=>8, 'valign' => 'center'));

    $innert1  = $cell->addTable(array('alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER));
    $innerrow1=$innert1->addRow();
    $innercell11 =$innerrow1->addCell(3000, array('bgColor' => 'ffffff'))->addTextRun(array('spaceAfter' => 1,'size' => 8));
    $innercell11->addText('Nombre y Apellido:',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'right'));
    $innercell11->addText('???',array('name' => 'Arial', 'size'=>8, 'valign' => 'right'));
    $innercell12 =$innerrow1->addCell(3000, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 1,'size' => 8));
    $innercell12->addText('C.I.:',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'right'));
    $innercell12->addText('???',array('name' => 'Arial', 'size'=>8, 'valign' => 'right'));
    $innercell13 =$innerrow1->addCell(3000, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 1,'size' => 8));
    $innercell13->addText('Extensión:',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'right'));
    $innercell13->addText('???',array('name' => 'Arial', 'size'=>8, 'valign' => 'right'));
    $innert2 = $cell->addTable(array('alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER));
    $innerrow2=$innert2->addRow();
    $innercell21=$innerrow2->addCell(3000, array('bgColor' => 'ffffff'))->addTextRun(array('spaceAfter' => 1,'size' => 8));
    $innercell21->addText('Correo:',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'right'));
    $innercell21->addText('???',array('name' => 'Arial', 'size'=>8, 'valign' => 'right'));
    $innercell22=$innerrow2->addCell(3000, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 1,'size' => 8));
    $innercell22->addText('Supervisor:',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'right'));
    $innercell22->addText('???',array('name' => 'Arial', 'size'=>8, 'valign' => 'right'));
    $innercell23=$innerrow2->addCell(3000, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 1,'size' => 8));
    $innercell23->addText('Area:',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'right'));
    $innercell23->addText('???',array('name' => 'Arial', 'size'=>8, 'valign' => 'right'));
    $innert3 = $cell->addTable(array('alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER));
    $innerrow3=$innert3->addRow();
    $innercell31=$innerrow3->addCell(3000, array('bgColor' => 'ffffff'))->addTextRun(array('spaceAfter' => 1,'size' => 8));
    $innercell31->addText('Gerencia:',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'right'));
    $innercell31->addText('???',array('name' => 'Arial', 'size'=>8, 'valign' => 'right'));
    $innercell32=$innerrow3->addCell(3000, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 1,'size' => 8));
    $innercell32->addText('Cargo:',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'right'));
    $innercell32->addText('???',array('name' => 'Arial', 'size'=>8, 'valign' => 'right'));
    $innercell33=$innerrow3->addCell(3000, array('bgColor' => 'ffffff','borderLeftSize'=>3))->addTextRun(array('spaceAfter' => 1,'size' => 8));
    $innercell33->addText('Ubicación:',array('name' => 'Arial','bold'=>true, 'size'=>9, 'valign' => 'right'));
    $innercell33->addText('???',array('name' => 'Arial', 'size'=>8, 'valign' => 'right'));

    /*
        $table->addRow();
        $table->addCell(null, array('borderTopColor'=>'FFFFFF','vMerge' => 'continue'));
        $table->addCell(5000, array('borderTopColor'=>'FFFFFF','cellMargin' => 80,'gridSpan' => 2,'valign' => 'center'))
              ->addText('ASIGNACIÓN DE EQUIPOS DE INFORMÁTICA Y TELECOMUNICACIONES', array('name'=>'Arial','bold' => true,'color'=>'black', 'size'=>10,'valign' => 'center'),$cellHCentered);
        $table->addCell(null, $cellRowContinue);
    */

    // Saving the document as OOXML file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('helloWorld.docx');

    // Saving the document as ODF file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
        $objWriter->save('helloWorld.odt');

    // Saving the document as HTML file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
        $objWriter->save('helloWorld.html');
}
//
/////


}
