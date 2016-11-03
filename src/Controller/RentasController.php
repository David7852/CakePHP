<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Rentas Controller
 *
 * @property \App\Model\Table\RentasTable $Rentas
 */
class RentasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $rentas = $this->paginate($this->Rentas);

        $this->set(compact('rentas'));
        $this->set('_serialize', ['rentas']);
    }

    /**
     * View method
     *
     * @param string|null $id Renta id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $renta = $this->Rentas->get($id, [
            'contain' => ['Lineas']
        ]);

        $this->set('renta', $renta);
        $this->set('_serialize', ['renta']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $renta = $this->Rentas->newEntity();
        if ($this->request->is('post')) {
            $renta = $this->Rentas->patchEntity($renta, $this->request->data);
            if ($this->Rentas->save($renta)) {
                $this->Flash->success(__('The renta has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The renta could not be saved. Please, try again.'));
            }
        }
        $lineas = $this->Rentas->Lineas->find('list', ['limit' => 200]);
        $this->set(compact('renta', 'lineas'));
        $this->set('_serialize', ['renta']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Renta id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $renta = $this->Rentas->get($id, [
            'contain' => ['Lineas']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $renta = $this->Rentas->patchEntity($renta, $this->request->data);
            if ($this->Rentas->save($renta)) {
                $this->Flash->success(__('The renta has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The renta could not be saved. Please, try again.'));
            }
        }
        $lineas = $this->Rentas->Lineas->find('list', ['limit' => 200]);
        $this->set(compact('renta', 'lineas'));
        $this->set('_serialize', ['renta']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Renta id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $renta = $this->Rentas->get($id);
        if ($this->Rentas->delete($renta)) {
            $this->Flash->success(__('The renta has been deleted.'));
        } else {
            $this->Flash->error(__('The renta could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
