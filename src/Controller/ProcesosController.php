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
            'contain' => ['Trabajadores', 'Asignaciones', 'Devoluciones']
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
                $this->Flash->success(__('El proceso fue registrado.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El proceso no pudo ser guardado. Intente nuevamente.'));
            }
        }
        $trabajadores = $this->Procesos->Trabajadores->find('list', ['limit' => 200]);
        $this->set(compact('proceso', 'trabajadores'));
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
            'contain' => ['Trabajadores']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $proceso = $this->Procesos->patchEntity($proceso, $this->request->data);
            if ($this->Procesos->save($proceso)) {
                $this->Flash->success(__('Los cambios en el proceso fueron registrados.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Los cambios no pudieron ser guardados. Intente nuevamente.'));
            }
        }
        $trabajadores = $this->Procesos->Trabajadores->find('list', ['limit' => 200]);
        $this->set(compact('proceso', 'trabajadores'));
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
            $this->Flash->success(__('El proceso fue eliminado.'));
        } else {
            $this->Flash->error(__('El Proceso no pudo ser eliminado. Intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
