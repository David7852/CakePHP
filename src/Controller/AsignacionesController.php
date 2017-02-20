<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Asignaciones Controller
 *
 * @property \App\Model\Table\AsignacionesTable $Asignaciones
 */
class AsignacionesController extends AppController
{

    public function getRelated($id)
    {

        if($id==null)
            return null;
        $asignacion = $this->Asignaciones->get($id, [
            'contain' => ['Procesos', 'Articulos']
        ]);

        return $asignacion;
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($id = null)
    {
        $this->paginate = [
        'contain' => ['Procesos', 'Articulos']    ];
        if($this->request->session()->read('Auth.User.funcion')=='Visitante'||$id!=null) {
            $asignaciones=array();
            $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
            ->where(['trabajador_id ='=>$this->request->session()->read('Auth.User.trabajador_id')]);
            foreach ($pro_tra as $p)
            {
                $asig=TableRegistry::get('Asignaciones')->find('all')
                    ->where(['proceso_id ='=>$p->proceso_id])
                    ->andWhere(['hasta >='=>date('Y-m-d')]);
                foreach ($asig as $nacion)
                    array_push($asignaciones, $nacion->id);
            }
            if(empty($asignaciones)){
                if($this->request->session()->read('Auth.User.funcion')=='Visitante')
                    $this->Flash->error(__('Usted no tiene Asignaciones a su nombre.'));
                else
                    $this->Flash->error(__('Usted no esta asignado para realizar ninguna Asignación.'));
                return $this->redirect($this->referer());
            }
            $asignaciones = $this->paginate($this->Asignaciones->find('all',array('conditions'=>array('Asignaciones.id IN'=>$asignaciones))));
        }else
            $asignaciones = $this->paginate($this->Asignaciones);

        $this->set(compact('asignaciones'));
        $this->set('_serialize', ['asignaciones']);
    }
    /**
     * View method
     *
     * @param string|null $id Asignacion id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $asig=TableRegistry::get('Asignaciones')->get($id);
            $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find();
            if($pro_tra->isEmpty()){
                $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
                return $this->redirect($this->referer());
            }
            $found=false;
            foreach ($pro_tra as $rowpt)
                if($rowpt->proceso_id==$asig->proceso_id&&$rowpt->trabajador_id==$this->request->session()->read('Auth.User.trabajador_id'))
                    $found=true;
            if(!$found){
                $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
                return $this->redirect($this->referer());
            }
        }
        $asignacion = $this->Asignaciones->get($id, [
            'contain' => ['Procesos', 'Articulos']
        ]);

        $this->set('asignacion', $asignacion);
        $this->set('_serialize', ['asignacion']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
        $asignacion = $this->Asignaciones->newEntity();
        if ($this->request->is('post')) {
            $asignacion = $this->Asignaciones->patchEntity($asignacion, $this->request->data);
            if ($this->Asignaciones->save($asignacion)) {
                $this->Flash->success(__('La asignacion ha sido guardada.'));
                return $this->redirect(['controller'=>'Procesos','action' => 'view',$asignacion->proceso_id]);
            } else {
                $this->Flash->error(__('La asignacion no pudo ser guardada. Intente nuevamente.'));
            }
        }
        $procesos = $this->Asignaciones->Procesos->find('list', ['limit' => 500]);
        $articulos = $this->Asignaciones->Articulos->find('list', ['limit' => 500]);
        $this->set(compact('asignacion', 'procesos', 'articulos'));
        $this->set('_serialize', ['asignacion']);
    }
    /**
     * Asociar method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function asociar($id = null)
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }else{
            $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
                ->where(['proceso_id ='=>$id])
                ->andWhere(['trabajador_id ='=>$this->request->session()->read('Auth.User.trabajador_id')])
                ->andwhere(['rol !=' => 'Solicitante']);
            if($pro_tra==null||$pro_tra->isEmpty()){
                $this->Flash->error(__('Usted no esta asignado a este proceso y por tanto no puede realizar asociaciones.'));
                return $this->redirect($this->referer());
            }
        }
        $asignacion = $this->Asignaciones->newEntity();
        if ($this->request->is('post')) {
            $asignacion = $this->Asignaciones->patchEntity($asignacion, $this->request->data);
            if ($this->Asignaciones->save($asignacion)) {
                $this->Flash->success(__('La asignacion ha sido guardada.'));
                return $this->redirect(['controller'=>'Procesos','action' => 'view',$id]);
            } else {
                $this->Flash->error(__('La asignacion no pudo ser guardada. Intente nuevamente.'));
            }
        }
        $procesos = $this->Asignaciones->Procesos->find('all')
        ->where(['estado ='=>'Aprobado'])
        ->orWhere(['id ='=>$id])
        ->orWhere(['estado ='=>'Completado']);
        $articulos = array();
        foreach ($procesos as $proc) {
            $asig=TableRegistry::get('Asignaciones')->find('all')
                ->where(['proceso_id ='=>$proc->id])
                ->andWhere(['hasta >='=>date('Y-m-d')]);
            foreach ($asig as $as) {
                array_push($articulos, $as->articulo_id);
            }
        }
        if(!empty($articulos))
            $articulos = $this->Asignaciones->Articulos->find('list',array('conditions'=>array('Articulos.id NOT IN'=>$articulos)));
        else
            $articulos = $this->Asignaciones->Articulos->find('list',['limit' => 500]);
        $procesos = $this->Asignaciones->Procesos->find('list')
            ->where(['id ='=>$id]);
        $this->set(compact('asignacion', 'procesos', 'articulos'));
        $this->set('_serialize', ['asignacion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Asignacion id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
        $asignacion = $this->Asignaciones->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $asignacion = $this->Asignaciones->patchEntity($asignacion, $this->request->data);
            if ($this->Asignaciones->save($asignacion)) {
                $this->Flash->success(__('Los cambios en la asignacion fueron guardados.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Los cambios en la asignacion no pudieron guardarse. Intente nuevamente.'));
            }
        }
        $procesos = $this->Asignaciones->Procesos->find('list', ['limit' => 500]);
        $articulos = $this->Asignaciones->Articulos->find('list', ['limit' => 500]);
        $this->set(compact('asignacion', 'procesos', 'articulos'));
        $this->set('_serialize', ['asignacion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Asignacion id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function delete($id = null)
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la accion solicitada.'));
            return $this->redirect($this->referer());
        }
        $this->request->allowMethod(['post', 'delete']);
        $asignacion = $this->Asignaciones->get($id);
        if ($this->Asignaciones->delete($asignacion)) {
            $this->Flash->success(__('L asignacion a sido eliminada.'));
        } else {
            $this->Flash->error(__('La asignacion no pudo eliminarse. Intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
