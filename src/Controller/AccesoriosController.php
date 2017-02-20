<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Accesorios Controller
 *
 * @property \App\Model\Table\AccesoriosTable $Accesorios
 */
class AccesoriosController extends AppController
{

    public function getRelated($id)
    {
        if($id==null)
            return null;
        $accesorio = $this->Accesorios->get($id, [
            'contain' => ['Articulos']
        ]);
        return $accesorio;
    }
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

        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $accesorios=array();
            $acces=TableRegistry::get('Accesorios')->find('all');
            foreach ($acces as $acc){
                $asig=TableRegistry::get('Asignaciones')->find('all')
                    ->where(['articulo_id ='=>$acc->articulo_id])
                    ->andWhere(['hasta >='=>date('Y-m-d')]);
                foreach ($asig as $row){
                    $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
                        ->where(['proceso_id ='=>$row->proceso_id])
                        ->andWhere(['trabajador_id ='=>$this->request->session()->read('Auth.User.trabajador_id')])
                        ->andWhere(['rol ='=>'Solicitante']);;
                    if($pro_tra!=null&&!$pro_tra->isEmpty()){
                        array_push($accesorios, $acc->id);
                    }
                }
            }
            if(empty($accesorios)){
                $this->Flash->error(__('Usted no tiene Accesorios asignados.'));
                return $this->redirect($this->referer());
            }
            $accesorios = $this->paginate($this->Accesorios->find('all',array('conditions'=>array('Accesorios.id IN'=>$accesorios))));

        }else
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
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $asig=TableRegistry::get('Asignaciones')->find('all')
                ->where(['articulo_id ='=>$accesorio->articulo_id])
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
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
        $accesorio = $this->Accesorios->newEntity();
        if ($this->request->is('post')) {
            $accesorio = $this->Accesorios->patchEntity($accesorio, $this->request->data);
            if ($this->Accesorios->save($accesorio)) {
                $this->Flash->success(__('El accesorio fue guardado.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El accesorio no pudo guardarse. Intente nuevamente.'));
            }
        }
        $articulos = $this->Accesorios->Articulos->find('list', ['limit' => 500]);
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
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
        $accesorio = $this->Accesorios->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $accesorio = $this->Accesorios->patchEntity($accesorio, $this->request->data);
            if ($this->Accesorios->save($accesorio)) {
                $this->Flash->success(__('Los cambios en el accesorio fueron guardados.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Los cambios en el accesorio no pudieron guardarse. Intente nuevamente'));
            }
        }
        $articulos = $this->Accesorios->Articulos->find('list', ['limit' => 500]);
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
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
        $this->request->allowMethod(['post', 'delete']);
        $accesorio = $this->Accesorios->get($id);
        if ($this->Accesorios->delete($accesorio)) {
            $this->Flash->success(__('El accesorio fue eliminar.'));
        } else {
            $this->Flash->error(__('El accesorio no pudo eliminarse. Intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
