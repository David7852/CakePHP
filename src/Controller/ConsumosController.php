<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Consumos Controller
 *
 * @property \App\Model\Table\ConsumosTable $Consumos
 */
class ConsumosController extends AppController
{

    public function getRelated($id)
    {
        $consumo = $this->Consumos->get($id, [
            'contain' => ['Facturas', 'Servicios']
        ]);
        return $consumo;
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Facturas', 'Servicios']
        ];
        $consumos = $this->paginate($this->Consumos);

        $this->set(compact('consumos'));
        $this->set('_serialize', ['consumos']);
    }

    /**
     * View method
     *
     * @param string|null $id Consumo id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $consumo = $this->Consumos->get($id, [
            'contain' => ['Facturas', 'Servicios']
        ]);

        $this->set('consumo', $consumo);
        $this->set('_serialize', ['consumo']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $consumo = $this->Consumos->newEntity();
        if ($this->request->is('post')) {
            $consumo = $this->Consumos->patchEntity($consumo, $this->request->data);
            if ($this->Consumos->save($consumo)) {
                $this->Flash->success(__('The consumo has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The consumo could not be saved. Please, try again.'));
            }
        }
        $facturas = $this->Consumos->Facturas->find('list', ['limit' => 200]);
        $servicios = $this->Consumos->Servicios->find('list', ['limit' => 200]);
        $this->set(compact('consumo', 'facturas', 'servicios'));
        $this->set('_serialize', ['consumo']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Consumo id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $consumo = $this->Consumos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $consumo = $this->Consumos->patchEntity($consumo, $this->request->data);
            if ($this->Consumos->save($consumo)) {
                $this->Flash->success(__('The consumo has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The consumo could not be saved. Please, try again.'));
            }
        }
        $facturas = $this->Consumos->Facturas->find('list', ['limit' => 200]);
        $servicios = $this->Consumos->Servicios->find('list', ['limit' => 200]);
        $this->set(compact('consumo', 'facturas', 'servicios'));
        $this->set('_serialize', ['consumo']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Consumo id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $consumo = $this->Consumos->get($id);
        if ($this->Consumos->delete($consumo)) {
            $this->Flash->success(__('The consumo has been deleted.'));
        } else {
            $this->Flash->error(__('The consumo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
