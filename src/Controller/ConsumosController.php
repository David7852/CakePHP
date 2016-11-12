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

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Facturas', 'Rentas']
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
            'contain' => ['Facturas', 'Rentas']
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
                $this->Flash->success(__('El consumo ha sido guardado.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El consumo no pudo ser guardado. Intente nuevamente.'));
            }
        }
        $facturas = $this->Consumos->Facturas->find('list', ['limit' => 200]);
        $rentas = $this->Consumos->Rentas->find('list', ['limit' => 200]);
        $this->set(compact('consumo', 'facturas', 'rentas'));
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
                $this->Flash->success(__('Los cambios en el consumo fueron guardados.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Los cambios en el consumo no pudieron guardarse. Intente nuevamente.'));
            }
        }
        $facturas = $this->Consumos->Facturas->find('list', ['limit' => 200]);
        $rentas = $this->Consumos->Rentas->find('list', ['limit' => 200]);
        $this->set(compact('consumo', 'facturas', 'rentas'));
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
            $this->Flash->success(__('El consumo ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El consumo no ha podido eliminarse. Intente nuevamente'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
