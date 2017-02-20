<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ProcesosTrabajadores Controller
 *
 * @property \App\Model\Table\ProcesosTrabajadoresTable $ProcesosTrabajadores
 */
class ProcesosTrabajadoresController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Trabajadores', 'Procesos']
        ];
        $procesosTrabajadores = $this->paginate($this->ProcesosTrabajadores);

        $this->set(compact('procesosTrabajadores'));
        $this->set('_serialize', ['procesosTrabajadores']);
    }

    /**
     * View method
     *
     * @param string|null $id Procesos Trabajadore id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $procesosTrabajadore = $this->ProcesosTrabajadores->get($id, [
            'contain' => ['Trabajadores', 'Procesos']
        ]);

        $this->set('procesosTrabajadore', $procesosTrabajadore);
        $this->set('_serialize', ['procesosTrabajadore']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $procesosTrabajadore = $this->ProcesosTrabajadores->newEntity();
        if ($this->request->is('post')) {
            $procesosTrabajadore = $this->ProcesosTrabajadores->patchEntity($procesosTrabajadore, $this->request->data);
            if ($this->ProcesosTrabajadores->save($procesosTrabajadore)) {
                $this->Flash->success(__('The procesos trabajadore has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The procesos trabajadore could not be saved. Please, try again.'));
            }
        }
        $trabajadores = $this->ProcesosTrabajadores->Trabajadores->find('list', ['limit' => 500]);
        $procesos = $this->ProcesosTrabajadores->Procesos->find('list', ['limit' => 500]);
        $this->set(compact('procesosTrabajadore', 'trabajadores', 'procesos'));
        $this->set('_serialize', ['procesosTrabajadore']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Procesos Trabajadore id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $procesosTrabajadore = $this->ProcesosTrabajadores->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $procesosTrabajadore = $this->ProcesosTrabajadores->patchEntity($procesosTrabajadore, $this->request->data);
            if ($this->ProcesosTrabajadores->save($procesosTrabajadore)) {
                $this->Flash->success(__('The procesos trabajadore has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The procesos trabajadore could not be saved. Please, try again.'));
            }
        }
        $trabajadores = $this->ProcesosTrabajadores->Trabajadores->find('list', ['limit' => 500]);
        $procesos = $this->ProcesosTrabajadores->Procesos->find('list', ['limit' => 500]);
        $this->set(compact('procesosTrabajadore', 'trabajadores', 'procesos'));
        $this->set('_serialize', ['procesosTrabajadore']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Procesos Trabajadore id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $procesosTrabajadore = $this->ProcesosTrabajadores->get($id);
        if ($this->ProcesosTrabajadores->delete($procesosTrabajadore)) {
            $this->Flash->success(__('The procesos trabajadore has been deleted.'));
        } else {
            $this->Flash->error(__('The procesos trabajadore could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
