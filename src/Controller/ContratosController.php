<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Contratos Controller
 *
 * @property \App\Model\Table\ContratosTable $Contratos
 */
class ContratosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Trabajadores']
        ];
        if($this->request->session()->read('Auth.User.funcion')=='Visitante'||$this->request->session()->read('Auth.User.funcion')=='Operador') {
            $trabajador = TableRegistry::get('Trabajadores')->get(($this->request->session()->read('Auth.User.trabajador_id')));
            $gerencia=$trabajador->gerencia;
            $cargo=$trabajador->cargo;
            $contratos=array();
            if($cargo=="Gerente"||$cargo=="Supervisor"||$cargo=="Superintendente")  {
                $trabajador = TableRegistry::get('Trabajadores')->find('all')
                    ->where(['gerencia ='=>$gerencia]);
                foreach ($trabajador as $t) {
                    $contr=TableRegistry::get('Contratos')->find('all')
                        ->where(['trabajador_id ='=>$t->id]);
                }
            }
            else
                $contr=TableRegistry::get('Contratos')->find('all')
                    ->where(['trabajador_id ='=>$this->request->session()->read('Auth.User.trabajador_id')]);
            foreach ($contr as $atos)
                array_push($contratos,$atos->id);
            if(empty($contratos))
            {
                $this->Flash->error(__('No hay Contratos a su nombre que pueda ver.'));
                return $this->redirect($this->referer());
            }
            $contratos = $this->paginate($this->Contratos->find('all',array('conditions'=>array('Contratos.id IN'=>$contratos))));
        }else
            $contratos = $this->paginate($this->Contratos);
        $this->set(compact('contratos'));
        $this->set('_serialize', ['contratos']);
    }

    /**
     * View method
     *
     * @param string|null $id Contrato id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante'||$this->request->session()->read('Auth.User.funcion')=='Operador')
        {
            if($this->request->session()->read('Auth.User.trabajador_id')!=$this->Contratos->get($id)->trabajador_id)
            {
                $trabajador = TableRegistry::get('Trabajadores')->get(($this->request->session()->read('Auth.User.trabajador_id')));
                $gerencia=$trabajador->gerencia;
                $cargo=$trabajador->cargo;
                $trabajador = TableRegistry::get('Trabajadores')->get($this->Contratos->get($id)->trabajador_id);
                if(empty($trabajador)||
                    $trabajador->gerencia!=$gerencia||
                    $trabajador->cargo=='Gerente'||
                    ($trabajador->cargo=='Supervisor'&&$cargo!='Gerente')||
                    ($trabajador->cargo=='Superintendente'&&$cargo!='Gerente')) {
                $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
                return $this->redirect($this->referer());
                }
            }
        }
        $contrato = $this->Contratos->get($id, [
            'contain' => ['Trabajadores']
        ]);
        $this->set('contrato', $contrato);
        $this->set('_serialize', ['contrato']);
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
        $contrato = $this->Contratos->newEntity();
        if ($this->request->is('post')) {
            $contrato = $this->Contratos->patchEntity($contrato, $this->request->data);
            if ($this->Contratos->save($contrato)) {
                $this->Flash->success(__('El contrato a sido guardado.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El contrato no pudo guardarse. Intente nuevamente .'));
            }
        }
        $trabajadores = $this->Contratos->Trabajadores->find('list', ['limit' => 500]);
        $this->set(compact('contrato', 'trabajadores'));
        $this->set('_serialize', ['contrato']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Contrato id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante'||$this->request->session()->read('Auth.User.funcion')=='Operador')
        {
            if($this->request->session()->read('Auth.User.trabajador_id')!=$this->Contratos->get($id)->trabajador_id)
            {
                $trabajador = TableRegistry::get('Trabajadores')->get(($this->request->session()->read('Auth.User.trabajador_id')));
                $gerencia=$trabajador->gerencia;
                $cargo=$trabajador->cargo;
                $trabajador = TableRegistry::get('Trabajadores')->get($this->Contratos->get($id)->trabajador_id);
                if(empty($trabajador)||
                    $trabajador->gerencia!=$gerencia||
                    $trabajador->cargo=='Gerente'||
                    ($trabajador->cargo=='Supervisor'&&$cargo!='Gerente')||
                    ($trabajador->cargo=='Superintendente'&&$cargo!='Gerente')) {
                    $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
                    return $this->redirect($this->referer());
                }
            }
        }

        $contrato = $this->Contratos->get($id, ['contain' => []]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contrato = $this->Contratos->patchEntity($contrato, $this->request->data);
            if ($this->Contratos->save($contrato)) {
                $this->Flash->success(__('Los cambios en el contrato fueron guardados.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Los cambios en el contrato no pudieron guardarse. Intente nuevamente'));
            }
        }
        $trabajadores = $this->Contratos->Trabajadores->find('list', ['limit' => 500]);
        $this->set(compact('contrato', 'trabajadores'));
        $this->set('_serialize', ['contrato']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Contrato id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante'||$this->request->session()->read('Auth.User.funcion')=='Operador') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la accion solicitada.'));
            return $this->redirect($this->referer());
        }
        $this->request->allowMethod(['post', 'delete']);
        $contrato = $this->Contratos->get($id);
        if ($this->Contratos->delete($contrato)) {
            $this->Flash->success(__('El contrato fue eliminado.'));
        } else {
            $this->Flash->error(__('El contrato no pudo eliminarse. Intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
