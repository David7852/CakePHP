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

    public function getRelated($id)
    {
        if($id==null)
            return null;
        $devolucion = $this->Devoluciones->get($id, [
            'contain' => ['Procesos','Articulos']
        ]);
        return $devolucion;
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($id = null)
    {
        $this->paginate = [
        'contain' => ['Procesos', 'Articulos']
        ];
        if($this->request->session()->read('Auth.User.funcion')=='Visitante'||$id!=null) {
            $devoluciones=array();
            $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
                ->where(['trabajador_id ='=>$this->request->session()->read('Auth.User.trabajador_id')]);
            foreach ($pro_tra as $p)
            {
                $devo=TableRegistry::get('Devoluciones')->find('all')
                    ->where(['proceso_id ='=>$p->proceso_id]);
                foreach ($devo as $lucion)
                    array_push($devoluciones, $lucion->id);
            }
            if(empty($devoluciones)){
                if($this->request->session()->read('Auth.User.funcion')=='Visitante')
                    $this->Flash->error(__('Usted no tiene Devoluciones a su nombre.'));
                else
                    $this->Flash->error(__('Usted no esta asignado para realizar ninguna Devolución.'));
                return $this->redirect($this->referer());
            }
            $devoluciones = $this->paginate($this->Devoluciones->find('all',array('conditions'=>array('Devoluciones.id IN'=>$devoluciones))));
        }else
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
            $devo=TableRegistry::get('Devoluciones')->get($id);
            $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find();
            if($pro_tra->isEmpty()){
                $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
                return $this->redirect($this->referer());
            }
            $found=false;
            foreach ($pro_tra as $rowpt)
                if($rowpt->proceso_id==$devo->proceso_id&&$rowpt->trabajador_id==$this->request->session()->read('Auth.User.trabajador_id'))
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
                return $this->redirect(['controller'=>'Procesos','action' => 'view',$devolucion->proceso_id]);
            } else {
                $this->Flash->error(__('La devolucion no pudo ser guardada. Intente nuevamente.'));
            }
        }
        $procesos = $this->Devoluciones->Procesos->find('list', ['limit' => 500]);
        $articulos = $this->Devoluciones->Articulos->find('list', ['limit' => 500]);
        $this->set(compact('devolucion', 'procesos', 'articulos'));
        $this->set('_serialize', ['devolucion']);
    }
    /**
     * Asociar method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function asociar($id = null)
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }else{
            $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
                ->where(['proceso_id ='=>$id])
                ->andWhere(['trabajador_id ='=>$this->request->session()->read('Auth.User.trabajador_id')])
                ->andwhere(['rol !=' => 'Solicitante']);
            if($pro_tra==null||$pro_tra->isEmpty()){
                $this->Flash->error(__('Usted no esta asignado a este proceso y por tanto no puede realizar asociaciones.'));
                return $this->redirect($this->referer());
            }
        }
        $devolucion = $this->Devoluciones->newEntity();
        if ($this->request->is('post')) {
            $devolucion = $this->Devoluciones->patchEntity($devolucion, $this->request->data);
            if ($this->Devoluciones->save($devolucion)) {
                $this->Flash->success(__('La devolucion ha sido guardada'));
                return $this->redirect(['controller'=>'Procesos','action' => 'view',$id]);
            } else {
                $this->Flash->error(__('La devolucion no pudo ser guardada. Intente nuevamente.'));
            }
        }
        $procesos = $this->Devoluciones->Procesos->find('list')
        ->where(['id ='=>$id]);
        $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
            ->where(['proceso_id ='=>$id])
            ->andWhere(['rol ='=>'Solicitante']);

        if(!empty($pro_tra)&&!$pro_tra->isEmpty()) {
            $solicitante_id=$pro_tra->first()->trabajador_id;
            $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
                ->where(['trabajador_id ='=>$solicitante_id])
                ->andWhere(['rol ='=>'Solicitante']);
        }
        $articulos = array();
        foreach ($pro_tra as $proc)
        {
            $asig=TableRegistry::get('Asignaciones')->find('all')
                ->where(['proceso_id ='=>$proc->proceso_id])
                ->andWhere(['hasta >='=>date('Y-m-d')]);
            foreach ($asig as $as) {
                array_push($articulos, $as->articulo_id);
            }
        }
        if(!empty($articulos))
            $articulos=$this->Devoluciones->Articulos->find('list',array('conditions'=>array('Articulos.id IN'=>$articulos)));
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
        $procesos = $this->Devoluciones->Procesos->find('list', ['limit' => 500]);
        $articulos = $this->Devoluciones->Articulos->find('list', ['limit' => 500]);
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
