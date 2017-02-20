<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * LineasRentas Controller
 *
 * @property \App\Model\Table\LineasRentasTable $LineasRentas
 */
class LineasRentasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Lineas', 'Rentas']
        ];
        $lineasRentas = $this->paginate($this->LineasRentas);

        $this->set(compact('lineasRentas'));
        $this->set('_serialize', ['lineasRentas']);
    }

    public function menu()
    {
        $this->paginate = [
            'contain' => ['Lineas', 'Rentas']
        ];
        $lineasRentas = $this->paginate($this->LineasRentas);

        $this->set(compact('lineasRentas'));
        $this->set('_serialize', ['lineasRentas']);
    }

    /**
     * View method
     *
     * @param string|null $id Lineas Renta id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lineasRenta = $this->LineasRentas->get($id, [
            'contain' => ['Lineas', 'Rentas']
        ]);

        $this->set('lineasRenta', $lineasRenta);
        $this->set('_serialize', ['lineasRenta']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lineasRenta = $this->LineasRentas->newEntity();
        if ($this->request->is('post')) {
            $lineasRenta = $this->LineasRentas->patchEntity($lineasRenta, $this->request->data);
            if ($this->LineasRentas->save($lineasRenta)) {
                $this->Flash->success(__('The lineas renta has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The lineas renta could not be saved. Please, try again.'));
            }
        }
        $lineas = $this->LineasRentas->Lineas->find('list', ['limit' => 500]);
        $rentas = $this->LineasRentas->Rentas->find('list', ['limit' => 500]);
        $this->set(compact('lineasRenta', 'lineas', 'rentas'));
        $this->set('_serialize', ['lineasRenta']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Lineas Renta id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lineasRenta = $this->LineasRentas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lineasRenta = $this->LineasRentas->patchEntity($lineasRenta, $this->request->data);
            if ($this->LineasRentas->save($lineasRenta)) {
                $this->Flash->success(__('The lineas renta has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The lineas renta could not be saved. Please, try again.'));
            }
        }
        $lineas = $this->LineasRentas->Lineas->find('list', ['limit' => 500]);
        $rentas = $this->LineasRentas->Rentas->find('list', ['limit' => 500]);
        $this->set(compact('lineasRenta', 'lineas', 'rentas'));
        $this->set('_serialize', ['lineasRenta']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Lineas Renta id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lineasRenta = $this->LineasRentas->get($id);
        if ($this->LineasRentas->delete($lineasRenta)) {
            $this->Flash->success(__('The lineas renta has been deleted.'));
        } else {
            $this->Flash->error(__('The lineas renta could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
