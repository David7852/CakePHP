<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Facturas Controller
 *
 * @property \App\Model\Table\FacturasTable $Facturas
 */
class FacturasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante'||$this->request->session()->read('Auth.User.funcion')=='Operador') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
        $this->paginate = [
            'contain' => ['Lineas']
        ];
        $facturas = $this->paginate($this->Facturas);

        $this->set(compact('facturas'));
        $this->set('_serialize', ['facturas']);
    }

    public function menu()
    {
        $this->paginate = [
            'contain' => ['Lineas']
        ];
        $facturas = $this->paginate($this->Facturas);

        $this->set(compact('facturas'));
        $this->set('_serialize', ['facturas']);
    }
    /**
     * View method
     *
     * @param string|null $id Factura id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante'||$this->request->session()->read('Auth.User.funcion')=='Operador') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
        $factura = $this->Facturas->get($id, [
            'contain' => ['Lineas', 'Consumos']
        ]);

        $this->set('factura', $factura);
        $this->set('_serialize', ['factura']);
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
        $factura = $this->Facturas->newEntity();
        if ($this->request->is('post')) {
            $factura = $this->Facturas->patchEntity($factura, $this->request->data);
            if ($this->Facturas->save($factura)) {
                $this->Flash->success(__('La factura ha sido registrada.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('La factura no ha podido ser registrada. Intente nuevamente.'));
            }
        }
        $lineas = $this->Facturas->Lineas->find('list', ['limit' => 200]);
        $this->set(compact('factura', 'lineas'));
        $this->set('_serialize', ['factura']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Factura id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante'||$this->request->session()->read('Auth.User.funcion')=='Operador') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
        $factura = $this->Facturas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $factura = $this->Facturas->patchEntity($factura, $this->request->data);
            if ($this->Facturas->save($factura)) {
                $this->Flash->success(__('Los cambios en la factura fueron guardados.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Los cambios en la factura no pudieron guardarse. Intente nuevamente.'));
            }
        }
        $lineas = $this->Facturas->Lineas->find('list', ['limit' => 200]);
        $this->set(compact('factura', 'lineas'));
        $this->set('_serialize', ['factura']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Factura id.
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
        $factura = $this->Facturas->get($id);
        if ($this->Facturas->delete($factura)) {
            $this->Flash->success(__('La factura ha sido eliminada.'));
        } else {
            $this->Flash->error(__('La factura no pudo eliminarse. Intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
