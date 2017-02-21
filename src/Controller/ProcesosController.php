<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Controller\Component\docmaker;
use Cake\ORM\TableRegistry;

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
        $trabajadores = $this->Procesos->Trabajadores->find('list', ['limit' => 500]);
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
        $solicitantes= $this->Procesos->Trabajadores->find('list', ['limit' => 500]);
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
        if(!$pro_tra->isEmpty())
            foreach ($pro_tra as $pt)
                array_push($s,$pt->trabajador_id);
        if(!empty($s)){
            $solicitantes = $this->Procesos->Trabajadores->find('list',array('limit' => 500,'conditions'=>array('Trabajadores.id IN'=>$s)));
            $trabajadores = $this->Procesos->Trabajadores->find('list',array('limit' => 500,'conditions'=>array('Trabajadores.id NOT IN'=>$s)))
                ->where(['gerencia =' => 'IT'])
                ->andWhere(['id !='=>$this->request->session()->read('Auth.User.trabajador_id')]);
        }
        else
        {
            $solicitantes = $this->Procesos->Trabajadores->find('list',array('limit' => 500));
            $trabajadores = $this->Procesos->Trabajadores->find('list',array('limit' => 500))
                ->where(['gerencia =' => 'IT'])
                ->andWhere(['id !='=>$this->request->session()->read('Auth.User.trabajador_id')]);
        }
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


        $this->set('proceso', $proceso);
        $this->set('_serialize', ['proceso']);
    }

    public function planilla($id=null)
    {
        $this->autoRender = false;
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $this->Flash->error(__('Usted no tiene permiso para realizar esta accion.'));
            return $this->redirect($this->referer());
        }
        $proceso = $this->Procesos->get($id, [
            'contain' => ['Trabajadores', 'Asignaciones', 'Devoluciones']
        ]);
        $solicitante=$proceso->solicitantetrb;
        $supervisor=$proceso->supervisortrb;
        $encargado=$proceso->encargadotrb;
        if($solicitante==null||$supervisor==null||$encargado==null){
            $this->Flash->error(__('Este proceso es irregular o tiene datos incompletos, fue imposible generar su planilla.'));
            return $this->redirect($this->referer());
        }
        $planilla=new docmaker();
        if($proceso->tipo=='Asignacion'&&!empty($proceso->asignaciones))
            $planilla->tipoasignacion($proceso,$solicitante,$supervisor,$encargado);
        elseif($proceso->tipo=='Devolucion'&&!empty($proceso->devoluciones))
            $planilla->tipodevolucion($proceso,$solicitante,$supervisor,$encargado);
        elseif (!empty($proceso->devoluciones)&&!empty($proceso->asignaciones))
            $planilla->tipomixto($proceso,$solicitante,$supervisor,$encargado);
        else{
            $this->Flash->error(__('Este proceso es irregular o tiene datos incompletos, fue imposible generar su planilla.'));
            return $this->redirect($this->referer());
        }
    }


}
