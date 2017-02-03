<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Modelos Controller
 *
 * @property \App\Model\Table\ModelosTable $Modelos
 */
class ModelosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $modelos = $this->paginate($this->Modelos);

        $this->set(compact('modelos'));
        $this->set('_serialize', ['modelos']);
    }
    /**
     * View method
     *
     * @param string|null $id Modelo id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $modelo = $this->Modelos->get($id, [
            'contain' => ['Articulos']
        ]);
        $this->set('modelo', $modelo);
        $this->set('_serialize', ['modelo']);
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
        $modelo = $this->Modelos->newEntity();
        if ($this->request->is('post')) {
            $modelo = $this->Modelos->patchEntity($modelo, $this->request->data);
            if ($this->Modelos->save($modelo)) {
                $this->Flash->success(__('El modelo fue registrado.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El modelo no pudo ser registrado. Intente nuevamente.'));
            }
        }
        $this->set(compact('modelo'));
        $this->set('_serialize', ['modelo']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Modelo id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
        $modelo = $this->Modelos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $modelo = $this->Modelos->patchEntity($modelo, $this->request->data);
            if ($this->Modelos->save($modelo)) {
                $this->Flash->success(__('Los cambios en el modelo fueron guardados.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Los cambios en el modelo no pudieron guardarse. Intente nuevamente.'));
            }
        }
        $this->set(compact('modelo'));
        $this->set('_serialize', ['modelo']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Modelo id.
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
        $modelo = $this->Modelos->get($id);
        if ($this->Modelos->delete($modelo)) {
            $this->Flash->success(__('El modelo fue eliminado'));
        } else {
            $this->Flash->error(__('El modelo no pudo eliminarse. Intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
