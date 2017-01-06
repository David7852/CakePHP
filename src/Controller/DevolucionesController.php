<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Devoluciones Controller
 *
 * @property \App\Model\Table\DevolucionesTable $Devoluciones
 */
class DevolucionesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante'||$this->request->session()->read('Auth.User.funcion')=='Operador') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
        $this->paginate = [
            'contain' => ['Procesos', 'Articulos']
        ];
        $devoluciones = $this->paginate($this->Devoluciones);

        $this->set(compact('devoluciones'));
        $this->set('_serialize', ['devoluciones']);
    }
    public function menu()
    {
        $this->paginate = [
            'contain' => ['Procesos', 'Articulos']
        ];
        $devoluciones = $this->paginate($this->Devoluciones);

        $this->set(compact('devoluciones'));
        $this->set('_serialize', ['devoluciones']);
    }

    /**
     * View method
     *
     * @param string|null $id Devolucion id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $devolucion=TableRegistry::get('Devoluviones')->get($id);
            $pro_trab=TableRegistry::get('ProcesosTrabajadores')->find();
            if($pro_trab->isEmpty()){
                $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
                return $this->redirect($this->referer());
            }
            $found=false;
            foreach ($pro_trab as $rowpt)
                if($rowpt->proceso_id==$devolucion->proceso_id&&$rowpt->trabajador_id==$this->request->session()->read('Auth.User.trabajador_id'))
                    $found=true;
            if(!$found){
                $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
                return $this->redirect($this->referer());
            }
        }

        $devolucion = $this->Devoluciones->get($id, [
            'contain' => ['Procesos', 'Articulos']
        ]);

        $this->set('devolucion', $devolucion);
        $this->set('_serialize', ['devolucion']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
        $devolucion = $this->Devoluciones->newEntity();
        if ($this->request->is('post')) {
            $devolucion = $this->Devoluciones->patchEntity($devolucion, $this->request->data);
            if ($this->Devoluciones->save($devolucion)) {
                $this->Flash->success(__('La devolucion ha sido guardada'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('La devolucion no pudo ser guardada. Intente nuevamente.'));
            }
        }
        $procesos = $this->Devoluciones->Procesos->find('list', ['limit' => 200]);
        $articulos = $this->Devoluciones->Articulos->find('list', ['limit' => 200]);
        $this->set(compact('devolucion', 'procesos', 'articulos'));
        $this->set('_serialize', ['devolucion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Devolucion id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
        $devolucion = $this->Devoluciones->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $devolucion = $this->Devoluciones->patchEntity($devolucion, $this->request->data);
            if ($this->Devoluciones->save($devolucion)) {
                $this->Flash->success(__('Los cambios en la devolucion fueron guardados'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Los cambios en la devolucion no pudieron guardarse. Intente nuevamente'));
            }
        }
        $procesos = $this->Devoluciones->Procesos->find('list', ['limit' => 200]);
        $articulos = $this->Devoluciones->Articulos->find('list', ['limit' => 200]);
        $this->set(compact('devolucion', 'procesos', 'articulos'));
        $this->set('_serialize', ['devolucion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Devolucion id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la accion solicitada.'));
            return $this->redirect($this->referer());
        }
        $this->request->allowMethod(['post', 'delete']);
        $devolucion = $this->Devoluciones->get($id);
        if ($this->Devoluciones->delete($devolucion)) {
            $this->Flash->success(__('La devolucion ha sido eliminada.'));
        } else {
            $this->Flash->error(__('La devolucion no pudo eliminarse. Intente nuevamente'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
