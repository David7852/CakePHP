<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Procesos Controller
 *
 * @property \App\Model\Table\ProcesosTable $Procesos
 */
class ProcesosController extends AppController
{

    public function solicitar()
    {
        $proceso = $this->Procesos->newEntity();
        if ($this->request->is('post')) {
            $proceso = $this->Procesos->patchEntity($proceso, $this->request->data);
            if ($this->Procesos->save($proceso)) {
                $this->Flash->success(__('La solicitud del proceso fue registrada.'));
                $p_t=TableRegistry::get('ProcesosTrabajadores')->newEntity();
                $p_t=TableRegistry::get('ProcesosTrabajadores')->patchEntity($p_t,
                    [
                        'trabajador_id'=>$this->request->session()->read('Auth.User.trabajador_id'),
                        'proceso_id'=>$proceso->id,
                        'rol'=>'Solicitante',
                    ]);
                if(!TableRegistry::get('ProcesosTrabajadores')->save($p_t))
                {
                    TableRegistry::get('Procesos')->delete($proceso);/////important
                    $this->Flash->error('El intento de registrar la solicitud fallo.');
                }
                return $this->redirect(['action' => 'menu']);
            } else {
                $this->Flash->error(__('El proceso no pudo ser guardado. Intente nuevamente.'));
            }
        }
        $trabajadores = $this->Procesos->Trabajadores->find('list', ['limit' => 200]);
        $this->set(compact('proceso', 'trabajadores'));
        $this->set('_serialize', ['proceso']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
        $procesos = $this->paginate($this->Procesos);
        $this->set(compact('procesos'));
        $this->set('_serialize', ['procesos']);
    }
    public function menu()
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
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
                ->where(['proceso_id ='=>$id])
                ->andWhere(['trabajador_id ='=>$this->request->session()->read('Auth.User.trabajador_id')]);
            if($pro_tra==null||$pro_tra->isEmpty()){
                $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
                return $this->redirect($this->referer());
            }
        }
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
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
        if($this->request->session()->read('Auth.User.funcion')=='Visitante'||$this->request->session()->read('Auth.User.funcion')=='Operador') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
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
        if($this->request->session()->read('Auth.User.funcion')=='Visitante'||$this->request->session()->read('Auth.User.funcion')=='Operador') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
        $proceso = $this->Procesos->get($id, [
            'contain' => ['Trabajadores']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $proceso = $this->Procesos->patchEntity($proceso, $this->request->data);
            if ($this->Procesos->save($proceso)) {
                $this->Flash->success(__('Los cambios en el proceso fueron registrados.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Los cambios no pudieron guardarse. Intente nuevamente.'));
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
        if($this->request->session()->read('Auth.User.funcion')!='Administrador'&&$this->request->session()->read('Auth.User.funcion')!='Superadministrador') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la accion solicitada.'));
            return $this->redirect($this->referer());
        }
        $this->request->allowMethod(['post', 'delete']);
        $proceso = $this->Procesos->get($id);
        if ($this->Procesos->delete($proceso)) {
            $this->Flash->success(__('El proceso fue eliminado.'));
        } else {
            $this->Flash->error(__('El Proceso no pudo eliminarse. Intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
