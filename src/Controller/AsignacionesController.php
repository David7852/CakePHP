<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Asignaciones Controller
 *
 * @property \App\Model\Table\AsignacionesTable $Asignaciones
 */
class AsignacionesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Procesos', 'Articulos']
        ];
        $asignaciones = $this->paginate($this->Asignaciones);

        $this->set(compact('asignaciones'));
        $this->set('_serialize', ['asignaciones']);
    }

    /**
     * View method
     *
     * @param string|null $id Asignacion id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $asignacion = $this->Asignaciones->get($id, [
            'contain' => ['Procesos', 'Articulos']
        ]);

        $this->set('asignacion', $asignacion);
        $this->set('_serialize', ['asignacion']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $asignacion = $this->Asignaciones->newEntity();
        if ($this->request->is('post')) {
            $asignacion = $this->Asignaciones->patchEntity($asignacion, $this->request->data);
            if ($this->Asignaciones->save($asignacion)) {
                $this->Flash->success(__('The asignacion has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The asignacion could not be saved. Please, try again.'));
            }
        }
        $procesos = $this->Asignaciones->Procesos->find('list', ['limit' => 200]);
        $articulos = $this->Asignaciones->Articulos->find('list', ['limit' => 200]);
        $this->set(compact('asignacion', 'procesos', 'articulos'));
        $this->set('_serialize', ['asignacion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Asignacion id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $asignacion = $this->Asignaciones->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $asignacion = $this->Asignaciones->patchEntity($asignacion, $this->request->data);
            if ($this->Asignaciones->save($asignacion)) {
                $this->Flash->success(__('The asignacion has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The asignacion could not be saved. Please, try again.'));
            }
        }
        $procesos = $this->Asignaciones->Procesos->find('list', ['limit' => 200]);
        $articulos = $this->Asignaciones->Articulos->find('list', ['limit' => 200]);
        $this->set(compact('asignacion', 'procesos', 'articulos'));
        $this->set('_serialize', ['asignacion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Asignacion id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $asignacion = $this->Asignaciones->get($id);
        if ($this->Asignaciones->delete($asignacion)) {
            $this->Flash->success(__('The asignacion has been deleted.'));
        } else {
            $this->Flash->error(__('The asignacion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
