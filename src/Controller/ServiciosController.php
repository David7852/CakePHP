<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Servicios Controller
 *
 * @property \App\Model\Table\ServiciosTable $Servicios
 */
class ServiciosController extends AppController
{

    public function getRelated($id)
    {
        if($id==null)
            return null;
        $servicio = $this->Servicios->get($id, [
            'contain' => ['Rentas', 'Consumos']
        ]);
        return $servicio;
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
            'contain' => ['Rentas']
        ];
        $servicios = $this->paginate($this->Servicios);

        $this->set(compact('servicios'));
        $this->set('_serialize', ['servicios']);
    }

    /**
     * View method
     *
     * @param string|null $id Servicio id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
        $servicio = $this->Servicios->get($id, [
            'contain' => ['Rentas', 'Consumos']
        ]);

        $this->set('servicio', $servicio);
        $this->set('_serialize', ['servicio']);
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
        $servicio = $this->Servicios->newEntity();
        if ($this->request->is('post')) {
            $servicio = $this->Servicios->patchEntity($servicio, $this->request->data);
            if ($this->Servicios->save($servicio)) {
                $this->Flash->success(__('El servicio ha sido guardado'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El servicio no pudo guardarse. Intente nuevamente.'));
            }
        }
        $rentas = $this->Servicios->Rentas->find('list', ['limit' => 500]);
        $this->set(compact('servicio', 'rentas'));
        $this->set('_serialize', ['servicio']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Servicio id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
        $servicio = $this->Servicios->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $servicio = $this->Servicios->patchEntity($servicio, $this->request->data);
            if ($this->Servicios->save($servicio)) {
                $this->Flash->success(__('Los cambios en el servicio fueron guardados.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Los cambios en el servicio no pudieron guardarse. Intente nuevamente'));
            }
        }
        $rentas = $this->Servicios->Rentas->find('list', ['limit' => 500]);
        $this->set(compact('servicio', 'rentas'));
        $this->set('_serialize', ['servicio']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Servicio id.
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
        $servicio = $this->Servicios->get($id);
        if ($this->Servicios->delete($servicio)) {
            $this->Flash->success(__('El servicio fue eliminado.'));
        } else {
            $this->Flash->error(__('El servicio no pudo eliminarse. Intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
