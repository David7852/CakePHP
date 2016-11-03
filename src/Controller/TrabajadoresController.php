<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Trabajadores Controller
 *
 * @property \App\Model\Table\TrabajadoresTable $Trabajadores
 */
class TrabajadoresController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $trabajadores = $this->paginate($this->Trabajadores);

        $this->set(compact('trabajadores'));
        $this->set('_serialize', ['trabajadores']);
    }

    /**
     * View method
     *
     * @param string|null $id Trabajador id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $trabajador = $this->Trabajadores->get($id, [
            'contain' => ['Procesos', 'Contratos', 'Usuarios']
        ]);

        $this->set('trabajador', $trabajador);
        $this->set('_serialize', ['trabajador']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $trabajador = $this->Trabajadores->newEntity();
        if ($this->request->is('post')) {
            $trabajador = $this->Trabajadores->patchEntity($trabajador, $this->request->data);
            if ($this->Trabajadores->save($trabajador)) {
                $this->Flash->success(__('The trabajador has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The trabajador could not be saved. Please, try again.'));
            }
        }
        $procesos = $this->Trabajadores->Procesos->find('list', ['limit' => 200]);
        $this->set(compact('trabajador', 'procesos'));
        $this->set('_serialize', ['trabajador']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Trabajador id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $trabajador = $this->Trabajadores->get($id, [
            'contain' => ['Procesos']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $trabajador = $this->Trabajadores->patchEntity($trabajador, $this->request->data);
            if ($this->Trabajadores->save($trabajador)) {
                $this->Flash->success(__('The trabajador has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The trabajador could not be saved. Please, try again.'));
            }
        }
        $procesos = $this->Trabajadores->Procesos->find('list', ['limit' => 200]);
        $this->set(compact('trabajador', 'procesos'));
        $this->set('_serialize', ['trabajador']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Trabajador id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $trabajador = $this->Trabajadores->get($id);
        if ($this->Trabajadores->delete($trabajador)) {
            $this->Flash->success(__('The trabajador has been deleted.'));
        } else {
            $this->Flash->error(__('The trabajador could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
