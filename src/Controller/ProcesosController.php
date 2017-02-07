<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\JcTable;
use PhpOffice\PhpWord\Style\Cell;

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
    // Create a new PHPWord Object
    $phpWord = new PHPWord();
    /* Note: any element you append to a document must reside inside of a Section. */
    // Adding an empty Section to the document...
    $section = $phpWord->addSection();
    /*
    // Adding Text element to the Section having font styled by default...
        $section->addText(
            '"Learn from yesterday, live for today, hope for tomorrow. '
            . 'The important thing is not to stop questioning." '
            . '(Albert Einstein)'
        );
    $header = array('size' => 16, 'bold' => true);*/



    /**
     *  3. colspan (gridSpan) and rowspan (vMerge)
     *  ---------------------
     *  |     |   B    |    |
     *  |  A  |--------|  E |
     *  |     | C |  D |    |
     *  ---------------------
     */

    $fancyTableStyle = array('borderSize' => 12, 'borderColor' => 'green');
    $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center', 'bgColor' => 'FFFFFF');
    $cellRowContinue = array('vMerge' => 'continue');
    $cellColSpan = array('cellMargin' => 80,'gridSpan' => 2, 'valign' => 'center');
    $cellHCentered = array('alignment' => Jc::CENTER);
    $cellVCentered = array('valign' => 'center');

    $spanTableStyleName = 'Colspan Rowspan';
    $phpWord->addTableStyle($spanTableStyleName, $fancyTableStyle);
    $table = $section->addTable($spanTableStyleName);

    $table->addRow();

    $cell1 = $table->addCell(2000, $cellRowSpan);
    $textrun1 = $cell1->addTextRun($cellHCentered);
    $textrun1->addImage('../webroot/img/fertinitrorif.png',array(
        'marginTop'     => -1,
        'marginLeft'    => -1,

    ));

    $cell2 = $table->addCell(5000, array('borderBottomColor'=>'FFFFFF','cellMargin' => 80,'gridSpan' => 2, 'valign' => 'center'));
    $textrun2 = $cell2->addTextRun($cellHCentered);
    $textrun2->addText('Fertilizantes Nitrogenados de Venezuela, FERTINITRO, C.E.C',array('name' => 'Arial Narrow','bold'=>true,'color'=>'green','size'=>'14'));

    $table->addCell(2000, $cellRowSpan)->addImage('../webroot/img/logoit.png',array(
        'positioning'      => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE,
        'posHorizontal'    => \PhpOffice\PhpWord\Style\Image::POSITION_HORIZONTAL_CENTER,
        'posHorizontalRel' => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_COLUMN,
        'posVertical'      => \PhpOffice\PhpWord\Style\Image::POSITION_VERTICAL_TOP,
        'posVerticalRel'   => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_LINE,
    'marginLeft'    => 1,
    'width'         => 88,
    'height'        => 70
));

    $table->addRow();
    $table->addCell(null, $cellRowContinue);
    $table->addCell(5000, array('borderTopColor'=>'FFFFFF','cellMargin' => 80,'gridSpan' => 2, 'valign' => 'center'))
        ->addText('ASIGNACIÓN DE EQUIPOS DE INFORMÁTICA Y TELECOMUNICACIONES', array('name'=>'Arial','bold' => true,'color'=>'black', 'size'=>10),$cellHCentered);
    $table->addCell(null, $cellRowContinue);





    // 1. Basic table
    $section->addTextBreak(1);
    $header = array('size' => 16, 'bold' => true);
    $section->addText('Fancy table', $header);

    $fancyTableStyleName = 'Fancy Table';
    $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '006699', 'cellMargin' => 80, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
    $fancyTableFirstRowStyle = array('borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF');
    $fancyTableCellStyle = array('valign' => 'center');
    $fancyTableCellBtlrStyle = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR);
    $fancyTableFontStyle = array('bold' => true);
    $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
    $table = $section->addTable($fancyTableStyleName);
    $table->addRow(900);
    $table->addCell(2000, $fancyTableCellStyle)->addText('Row 1', $fancyTableFontStyle);
    $table->addCell(2000, $fancyTableCellStyle)->addText('Row 2', $fancyTableFontStyle);
    $table->addCell(2000, $fancyTableCellStyle)->addText('Row 3', $fancyTableFontStyle);
    $table->addCell(2000, $fancyTableCellStyle)->addText('Row 4', $fancyTableFontStyle);
    $table->addCell(500, $fancyTableCellBtlrStyle)->addText('Row 5', $fancyTableFontStyle);
    for ($i = 1; $i <= 8; $i++) {
        $table->addRow();
        $table->addCell(2000)->addText("Cell {$i}");
        $table->addCell(2000)->addText("Cell {$i}");
        $table->addCell(2000)->addText("Cell {$i}");
        $table->addCell(2000)->addText("Cell {$i}");
        $text = (0== $i % 2) ? 'X' : '';
        $table->addCell(500)->addText($text);
    }




    /**
     *  4. colspan (gridSpan) and rowspan (vMerge)
     *  ---------------------
     *  |     |   B    |  1 |
     *  |  A  |        |----|
     *  |     |        |  2 |
     *  |     |---|----|----|
     *  |     | C |  D |  3 |
     *  ---------------------
     * @see https://github.com/PHPOffice/PHPWord/issues/806
     */
    $section->addPageBreak();
    $section->addText('Table with colspan and rowspan', $header);

    $styleTable = ['borderSize' => 6, 'borderColor' => '999999'];
    $phpWord->addTableStyle('Colspan Rowspan', $styleTable);
    $table = $section->addTable('Colspan Rowspan');

    $row = $table->addRow();

    $row->addCell(null, ['vMerge' => 'restart'])->addText('A');
    $row->addCell(null, ['gridSpan' => 2, 'vMerge' => 'restart',])->addText('B');
    $row->addCell()->addText('1');

    $row = $table->addRow();
    $row->addCell(null, ['vMerge' => 'continue']);
    $row->addCell(null, ['vMerge' => 'continue','gridSpan' => 2,]);
    $row->addCell()->addText('2');
    $row = $table->addRow();
    $row->addCell(null, ['vMerge' => 'continue']);
    $row->addCell()->addText('C');
    $row->addCell()->addText('D');
    $row->addCell()->addText('3');

// 5. Nested table

    $section->addTextBreak(2);
    $section->addText('Nested table in a centered and 50% width table.', $header);

    $table = $section->addTable(array('width' => 50 * 50, 'unit' => 'pct', 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER));
    $cell = $table->addRow()->addCell();
    $cell->addText('This cell contains nested table.');
    $innerCell = $cell->addTable(array('alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER))->addRow()->addCell();
    $innerCell->addText('Inside nested table');
    // Adding Text element with font customized using named font style...
        $fontStyleName = 'oneUserDefinedStyle';
        $phpWord->addFontStyle(
            $fontStyleName,
            array('name' => 'Tahoma', 'size' => 10, 'color' => '1B2232', 'bold' => true)
        );
        $section->addText(
            '"The greatest accomplishment is not in never falling, '
            . 'but in rising again after you fall." '
            . '(Vince Lombardi)',
            $fontStyleName
        );

    // Adding Text element with font customized using explicitly created font style object...
        $fontStyle = new \PhpOffice\PhpWord\Style\Font();
        $fontStyle->setBold(true);
        $fontStyle->setName('Tahoma');
        $fontStyle->setSize(13);
        $myTextElement = $section->addText('"Believe you can and you\'re halfway there." (Theodor Roosevelt)');
        $myTextElement->setFontStyle($fontStyle);

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
