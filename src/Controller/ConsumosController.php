<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Consumos Controller
 *
 * @property \App\Model\Table\ConsumosTable $Consumos
 */
class ConsumosController extends AppController
{

    public function getRelated($id)
    {
        if($id==null)
            return null;
        $consumo = $this->Consumos->get($id, [
            'contain' => ['Facturas', 'Servicios']
        ]);
        return $consumo;
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($id = null)
    {
        $this->paginate = [
            'contain' => ['Facturas', 'Servicios']
        ];
        if($this->request->session()->read('Auth.User.funcion')=='Visitante'||$id!=null)
        {
            $consumos=array();
            $lin=TableRegistry::get('Lineas')->find('all');
            foreach ($lin as $eas){
                $asig=TableRegistry::get('Asignaciones')->find('all')
                    ->where(['articulo_id ='=>$eas->articulo_id])
                    ->andWhere(['hasta >='=>date('Y-m-d')]);
                foreach ($asig as $row){
                    $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
                        ->where(['proceso_id ='=>$row->proceso_id])
                        ->andWhere(['trabajador_id ='=>$this->request->session()->read('Auth.User.trabajador_id')])
                        ->andWhere(['rol ='=>'Solicitante']);
                        if($pro_tra!=null&&!$pro_tra->isEmpty())
                        {
                            $facturas=TableRegistry::get('Facturas')->find('all')
                                ->where(['linea_id ='=>$eas->id]);
                            foreach ($facturas as $factura) {
                                $con = TableRegistry::get('Consumos')->find('all')
                                    ->where(['factura_id' => $factura->id]);
                                foreach ($con as $sumo)
                                    array_push($consumos, $sumo->id);
                            }
                        }else
                        {
                            $this->Flash->error(__('Usted no tiene Lineas asignadas. Por consiguiente, tampoco consumos.'));
                            return $this->redirect($this->referer());
                        }
                }
            }
            if(empty($consumos)){
                $this->Flash->error(__('Usted no tiene consumos registrados.'));
                return $this->redirect($this->referer());
            }
            $consumos = $this->paginate($this->Consumos->find('all',array('conditions'=>array('Consumos.id IN'=>$consumos))));
        }else
            $consumos = $this->paginate($this->Consumos);
        $this->set(compact('consumos'));
        $this->set('_serialize', ['consumos']);
    }
    /**
     * View method
     *
     * @param string|null $id Consumo id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante')
        {
            $factura=TableRegistry::get('Facturas')->find('all')->where(['id ='=>$id]);
            $linea=TableRegistry::get('Lineas')->find('all')->where(['id ='=>$factura->first()->linea_id]);
            $equipo=TableRegistry::get('Articulos')->find('all')->where(['id ='=>$linea->first()->articulo_id]);
            if($equipo==null||!$equipo->isEmpty())
            {
                $this->Flash->error(__('La linea de este consumo no esta asignada a ningún equipo.'));
                return $this->redirect($this->referer());
            }
            $asig=TableRegistry::get('Asignaciones')->find('all')
                ->where(['articulo_id ='=>$equipo->first()->id])
                ->andWhere(['hasta >='=>date('Y-m-d')]);
            $procesos=false;
            foreach ($asig as $nacion){
                $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
                    ->where(['proceso_id ='=>$nacion->proceso_id])
                    ->andWhere(['trabajador_id ='=>$this->request->session()->read('Auth.User.trabajador_id')])
                    ->andWhere(['rol ='=>'Solicitante']);
                if($pro_tra!=null&&!$pro_tra->isEmpty())
                    $procesos=true;
            }
            if(!$procesos)
            {
                $this->Flash->error(__('Usted no tiene Lineas asignadas, ni consumos que ver.'));
                return $this->redirect($this->referer());
            }
    }
        $consumo = $this->Consumos->get($id, [
            'contain' => ['Facturas', 'Servicios']
        ]);

        $this->set('consumo', $consumo);
        $this->set('_serialize', ['consumo']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
        $facturas = $this->Consumos->Facturas->find('list', ['limit' => 200]);
        if($id!=null) {
            $facturas=TableRegistry::get('Facturas')->find('list')
                ->where(['linea_id ='=>$id]);
            if($facturas->isEmpty()){
                $this->Flash->error(__('Esta linea no tiene facturas, cree una antes de agregar un consumo.'));
                return $this->redirect($this->referer());}
        }
        $consumo = $this->Consumos->newEntity();
        if ($this->request->is('post')) {
            $consumo = $this->Consumos->patchEntity($consumo, $this->request->data);
            if ($this->Consumos->save($consumo)) {
                $this->Flash->success(__('El consumo se ha registrado.'));
                if($id!=null)
                    return $this->redirect(['controller'=>'Lineas','action' => 'view', $id]);
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El consumo no pudo ser registrado. Intente nuevamente'));
            }
        }
        $servicios = $this->Consumos->Servicios->find('list', ['limit' => 200]);
        $this->set(compact('consumo', 'facturas', 'servicios'));
        $this->set('_serialize', ['consumo']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Consumo id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
        $consumo = $this->Consumos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $consumo = $this->Consumos->patchEntity($consumo, $this->request->data);
            if ($this->Consumos->save($consumo)) {
                $this->Flash->success(__('El consumo se ha registrado.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El consumo no pudo ser registrado. Intente nuevamente'));
            }
        }
        $facturas = $this->Consumos->Facturas->find('list', ['limit' => 200]);
        $servicios = $this->Consumos->Servicios->find('list', ['limit' => 200]);
        $this->set(compact('consumo', 'facturas', 'servicios'));
        $this->set('_serialize', ['consumo']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Consumo id.
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
        $consumo = $this->Consumos->get($id);
        if ($this->Consumos->delete($consumo)) {
            $this->Flash->success(__('El consumo se ha eliminado.'));
        } else {
            $this->Flash->error(__('El consumo no pudo eliminarse. Intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
