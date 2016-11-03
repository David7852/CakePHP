<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Procesos Controller
 *
 * @property \App\Model\Table\ProcesosTable $Procesos
 */
class ProcesosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Trabajors']
        ];
        $procesos = $this->paginate($this->Procesos);

        $this->set(compact('procesos'));
        $this->set('_serialize', ['procesos']);
    }

    /**
     * View method
     *
     * @param string|null $id Proceso id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $proceso = $this->Procesos->get($id, [
            'contain' => ['Trabajors']
        ]);

        $this->set('proceso', $proceso);
        $this->set('_serialize', ['proceso']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $proceso = $this->Procesos->newEntity();
        if ($this->request->is('post')) {
            $proceso = $this->Procesos->patchEntity($proceso, $this->request->data);
            if ($this->Procesos->save($proceso)) {
                $this->Flash->success(__('The proceso has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The proceso could not be saved. Please, try again.'));
            }
        }
        $trabajors = $this->Procesos->Trabajors->find('list', ['limit' => 200]);
        $this->set(compact('proceso', 'trabajors'));
        $this->set('_serialize', ['proceso']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Proceso id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $proceso = $this->Procesos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $proceso = $this->Procesos->patchEntity($proceso, $this->request->data);
            if ($this->Procesos->save($proceso)) {
                $this->Flash->success(__('The proceso has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The proceso could not be saved. Please, try again.'));
            }
        }
        $trabajors = $this->Procesos->Trabajors->find('list', ['limit' => 200]);
        $this->set(compact('proceso', 'trabajors'));
        $this->set('_serialize', ['proceso']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Proceso id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $proceso = $this->Procesos->get($id);
        if ($this->Procesos->delete($proceso)) {
            $this->Flash->success(__('The proceso has been deleted.'));
        } else {
            $this->Flash->error(__('The proceso could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
