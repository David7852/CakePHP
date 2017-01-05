<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Lineas Controller
 *
 * @property \App\Model\Table\LineasTable $Lineas
 */
class LineasController extends AppController
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
        $lineas = $this->paginate($this->Lineas);

        $this->set(compact('lineas'));
        $this->set('_serialize', ['lineas']);
    }

    public function menu()
    {
        $this->paginate = [
            'contain' => ['Articulos']
        ];
        $lineas = $this->paginate($this->Lineas);

        $this->set(compact('lineas'));
        $this->set('_serialize', ['lineas']);
    }

    /**
     * View method
     *
     * @param string|null $id Linea id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $linea = $this->Lineas->get($id, [
            'contain' => ['Articulos', 'Rentas', 'Facturas']
        ]);

        $this->set('linea', $linea);
        $this->set('_serialize', ['linea']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $linea = $this->Lineas->newEntity();
        if ($this->request->is('post')) {
            $linea = $this->Lineas->patchEntity($linea, $this->request->data);
            if ($this->Lineas->save($linea)) {
                $this->Flash->success(__('La linea fue registrada.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('La linea no pudo ser registrada. Intente nuevamente.'));
            }
        }
        $articulos = $this->Lineas->Articulos->find('list', ['limit' => 200]);//restringir para que solo muestre celulares o telefonos fijos
        $rentas = $this->Lineas->Rentas->find('list', ['limit' => 200]);
        $this->set(compact('linea', 'articulos', 'rentas'));
        $this->set('_serialize', ['linea']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Linea id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $linea = $this->Lineas->get($id, [
            'contain' => ['Rentas']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $linea = $this->Lineas->patchEntity($linea, $this->request->data);
            if ($this->Lineas->save($linea)) {
                $this->Flash->success(__('Los cambios en la linea fueron guardados.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Los cambios en la linea no pudieron guardarse. Intente nuevamente'));
            }
        }
        $articulos = $this->Lineas->Articulos->find('list', ['limit' => 200]);
        $rentas = $this->Lineas->Rentas->find('list', ['limit' => 200]);
        $this->set(compact('linea', 'articulos', 'rentas'));
        $this->set('_serialize', ['linea']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Linea id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $linea = $this->Lineas->get($id);
        if ($this->Lineas->delete($linea)) {
            $this->Flash->success(__('La linea ha sido eliminada                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    .'));
        } else {
            $this->Flash->error(__('La linea no pudo eliminarse. Intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
