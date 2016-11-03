<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Accesorios Controller
 *
 * @property \App\Model\Table\AccesoriosTable $Accesorios
 */
class AccesoriosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Articulos']
        ];
        $accesorios = $this->paginate($this->Accesorios);

        $this->set(compact('accesorios'));
        $this->set('_serialize', ['accesorios']);
    }

    /**
     * View method
     *
     * @param string|null $id Accesorio id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $accesorio = $this->Accesorios->get($id, [
            'contain' => ['Articulos']
        ]);

        $this->set('accesorio', $accesorio);
        $this->set('_serialize', ['accesorio']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $accesorio = $this->Accesorios->newEntity();
        if ($this->request->is('post')) {
            $accesorio = $this->Accesorios->patchEntity($accesorio, $this->request->data);
            if ($this->Accesorios->save($accesorio)) {
                $this->Flash->success(__('The accesorio has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The accesorio could not be saved. Please, try again.'));
            }
        }
        $articulos = $this->Accesorios->Articulos->find('list', ['limit' => 200]);
        $this->set(compact('accesorio', 'articulos'));
        $this->set('_serialize', ['accesorio']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Accesorio id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $accesorio = $this->Accesorios->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $accesorio = $this->Accesorios->patchEntity($accesorio, $this->request->data);
            if ($this->Accesorios->save($accesorio)) {
                $this->Flash->success(__('The accesorio has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The accesorio could not be saved. Please, try again.'));
            }
        }
        $articulos = $this->Accesorios->Articulos->find('list', ['limit' => 200]);
        $this->set(compact('accesorio', 'articulos'));
        $this->set('_serialize', ['accesorio']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Accesorio id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $accesorio = $this->Accesorios->get($id);
        if ($this->Accesorios->delete($accesorio)) {
            $this->Flash->success(__('The accesorio has been deleted.'));
        } else {
            $this->Flash->error(__('The accesorio could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
