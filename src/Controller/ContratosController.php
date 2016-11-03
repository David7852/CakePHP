<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Contratos Controller
 *
 * @property \App\Model\Table\ContratosTable $Contratos
 */
class ContratosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Trabajores']
        ];
        $contratos = $this->paginate($this->Contratos);

        $this->set(compact('contratos'));
        $this->set('_serialize', ['contratos']);
    }

    /**
     * View method
     *
     * @param string|null $id Contrato id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contrato = $this->Contratos->get($id, [
            'contain' => ['Trabajores']
        ]);

        $this->set('contrato', $contrato);
        $this->set('_serialize', ['contrato']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contrato = $this->Contratos->newEntity();
        if ($this->request->is('post')) {
            $contrato = $this->Contratos->patchEntity($contrato, $this->request->data);
            if ($this->Contratos->save($contrato)) {
                $this->Flash->success(__('The contrato has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The contrato could not be saved. Please, try again.'));
            }
        }
        $trabajores = $this->Contratos->Trabajores->find('list', ['limit' => 200]);
        $this->set(compact('contrato', 'trabajores'));
        $this->set('_serialize', ['contrato']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Contrato id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contrato = $this->Contratos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contrato = $this->Contratos->patchEntity($contrato, $this->request->data);
            if ($this->Contratos->save($contrato)) {
                $this->Flash->success(__('The contrato has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The contrato could not be saved. Please, try again.'));
            }
        }
        $trabajores = $this->Contratos->Trabajores->find('list', ['limit' => 200]);
        $this->set(compact('contrato', 'trabajores'));
        $this->set('_serialize', ['contrato']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Contrato id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contrato = $this->Contratos->get($id);
        if ($this->Contratos->delete($contrato)) {
            $this->Flash->success(__('The contrato has been deleted.'));
        } else {
            $this->Flash->error(__('The contrato could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
