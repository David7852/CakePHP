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
            'contain' => ['Procesos']
        ]);

        return $asignacion;
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
        $this->paginate = [
            'contain' => ['Procesos', 'Articulos']
        ];
        $asignaciones = $this->paginate($this->Asignaciones);

        $this->set(compact('asignaciones'));
        $this->set('_serialize', ['asignaciones']);
    }
    public function menu()
    {
        $this->paginate = [
            'contain' => ['Procesos', 'Articulos']
        ];
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
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('La asignacion no pudo ser guardada. Intente nuevamente.'));
            }
        }
        $procesos = $this->Asignaciones->Procesos->find('list', ['limit' => 200]);
        $articulos = $this->Asignaciones->Articulos->find('list', ['limit' => 200]);
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
        $procesos = $this->Asignaciones->Procesos->find('list', ['limit' => 200]);
        $articulos = $this->Asignaciones->Articulos->find('list', ['limit' => 200]);
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
