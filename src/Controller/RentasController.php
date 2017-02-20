<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Rentas Controller
 *
 * @property \App\Model\Table\RentasTable $Rentas
 */
class RentasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $rentas = $this->paginate($this->Rentas);

        $this->set(compact('rentas'));
        $this->set('_serialize', ['rentas']);
    }

    /**
     * View method
     *
     * @param string|null $id Renta id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $renta = $this->Rentas->get($id, [
            'contain' => ['Lineas', 'Servicios']
        ]);
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $lineas=$renta->lineas;
            foreach ($lineas as $l)
            {
                $asig=TableRegistry::get('Asignaciones')->find('all')
                    ->where(['articulo_id ='=>$l->articulo_id])
                    ->andWhere(['hasta >='=>date('Y-m-d')]);
                if($asig->isEmpty()){
                    $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
                    return $this->redirect($this->referer());
                }
                $found=false;
                foreach ($asig as $row){
                    $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
                        ->where(['proceso_id ='=>$row->proceso_id])
                        ->andWhere(['trabajador_id ='=>$this->request->session()->read('Auth.User.trabajador_id')]);
                    if($pro_tra!=null&&!$pro_tra->isEmpty()){
                        $found=true;
                        break;
                    }
                }
                if(!$found){
                    $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
                    return $this->redirect($this->referer());
                }
            }
        }
        $this->set('renta', $renta);
        $this->set('_serialize', ['renta']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if($this->request->session()->read('Auth.User.funcion')!='Administrador'&&$this->request->session()->read('Auth.User.funcion')!='Superadministrador') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la accion solicitada.'));
            return $this->redirect($this->referer());
        }
        $renta = $this->Rentas->newEntity();
        if ($this->request->is('post')) {
            $renta = $this->Rentas->patchEntity($renta, $this->request->data);
            if ($this->Rentas->save($renta)) {
                $this->Flash->success(__('La nueva renta mensual fue guardada.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('La renta no pudo ser guardada. Intente nuevamente.'));
            }
        }
        $lineas = $this->Rentas->Lineas->find('list', ['limit' => 500]);
        $this->set(compact('renta', 'lineas'));
        $this->set('_serialize', ['renta']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Renta id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if($this->request->session()->read('Auth.User.funcion')!='Administrador'&&$this->request->session()->read('Auth.User.funcion')!='Superadministrador') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la accion solicitada.'));
            return $this->redirect($this->referer());
        }
        $renta = $this->Rentas->get($id, [
            'contain' => ['Lineas']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $renta = $this->Rentas->patchEntity($renta, $this->request->data);
            if ($this->Rentas->save($renta)) {
                $this->Flash->success(__('Los cambios en la renta fueron registrados.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Los cambios en la renta no pudieron guardarse. Intente nuevamente'));
            }
        }
        $lineas = $this->Rentas->Lineas->find('list', ['limit' => 500]);
        $this->set(compact('renta', 'lineas'));
        $this->set('_serialize', ['renta']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Renta id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if($this->request->session()->read('Auth.User.funcion')!='Superadministrador') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la accion solicitada.'));
            return $this->redirect($this->referer());
        }
        $this->request->allowMethod(['post', 'delete']);
        $renta = $this->Rentas->get($id);
        if ($this->Rentas->delete($renta)) {
            $this->Flash->success(__('La renta fue eliminada y ya no estara disponible a nuevas lineas.'));
        } else {
            $this->Flash->error(__('La renta no pudo eliminarse. Intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
