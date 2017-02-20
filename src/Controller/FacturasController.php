<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use App\Controller\Component\docmaker;

/**
 * Facturas Controller
 *
 * @property \App\Model\Table\FacturasTable $Facturas
 */
class FacturasController extends AppController
{
    public function getRelated($id)
    {
        if($id==null)
            return null;
        $factura = $this->Facturas->get($id, [
            'contain' => ['Lineas', 'Consumos']
        ]);
        return $factura;
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($date = null)
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante'||$this->request->session()->read('Auth.User.funcion')=='Operador') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
        $this->paginate = [
            'contain' => ['Lineas']
        ];
        $b=0;
        if($date!=null)
        {
            $tempDate = explode('-', $date);
            if(sizeof($tempDate)<=2||!is_numeric($tempDate[0])||!is_numeric($tempDate[1])||!is_numeric($tempDate[2])||!checkdate($tempDate[1], $tempDate[2], $tempDate[0])){
                if($date!='dist')
                $this->Flash->error(__('El rango de fechas es incorrecto.'));
                return $this->redirect($this->referer());
            }
            $facturas = $this->paginate($this->Facturas->find('all')->where(['desde >='=>$date]));
            $facts=$this->Facturas->find('all')->where(['desde >='=>$date]);
            foreach ($facts as $fact)
                $b=$b+$fact->balance+$fact->cargos_extra;
        }else{
            $facturas = $this->paginate($this->Facturas);
            $b=null;
        }
        $this->set(compact('facturas','b'));
        $this->set('_serialize', ['facturas']);
    }

    /**
     * View method
     *
     * @param string|null $id Factura id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante'||$this->request->session()->read('Auth.User.funcion')=='Operador')
        {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
        $factura = $this->Facturas->get($id, [
            'contain' => ['Lineas', 'Consumos']
        ]);

        $this->set('factura', $factura);
        $this->set('_serialize', ['factura']);
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
        $factura = $this->Facturas->newEntity();
        if ($this->request->is('post')) {
            $factura = $this->Facturas->patchEntity($factura, $this->request->data);
            if ($this->Facturas->save($factura)) {
                $this->Flash->success(__('La factura ha sido registrada.'));

                return $this->redirect(['action' => 'view',$factura->id]);
            } else {
                $this->Flash->error(__('La factura no ha podido ser registrada. Intente nuevamente.'));
            }
        }
        $lineas = $this->Facturas->Lineas->find('list', ['limit' => 500]);
        $this->set(compact('factura', 'lineas'));
        $this->set('_serialize', ['factura']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Factura id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante'||$this->request->session()->read('Auth.User.funcion')=='Operador') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
        $factura = $this->Facturas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $factura = $this->Facturas->patchEntity($factura, $this->request->data);
            if ($this->Facturas->save($factura)) {
                $this->Flash->success(__('Los cambios en la factura fueron guardados.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Los cambios en la factura no pudieron guardarse. Intente nuevamente.'));
            }
        }
        $lineas = $this->Facturas->Lineas->find('list', ['limit' => 500]);
        $this->set(compact('factura', 'lineas'));
        $this->set('_serialize', ['factura']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Factura id.
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
        $factura = $this->Facturas->get($id);
        if ($this->Facturas->delete($factura)) {
            $this->Flash->success(__('La factura ha sido eliminada.'));
        } else {
            $this->Flash->error(__('La factura no pudo eliminarse. Intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function facturacion($date)
    {
        $this->autoRender = false;
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $this->Flash->error(__('Usted no tiene permiso para realizar esta accion.'));
            return $this->redirect($this->referer());
        }
        $facuracion=new docmaker();
        $fact=$this->Facturas->find('all')->where(['desde >='=>$date])->order(['created' => 'DESC']);
        if($fact->isEmpty())
        {
            $this->Flash->error(__('Los registros de facturación son muy pocos o incompletos.'));
            return $this->redirect($this->referer());
        }
        $facuracion->facturacion($fact,$this->request->session()->read('Auth.User.nombre_de_usuario'));
    }

    public function aprobar($date=null)
    {
        $this->autoRender = false;
        if($this->request->session()->read('Auth.User.funcion')!='Superadministrador') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la accion solicitada.'));
            return $this->redirect($this->referer());
        }
        $this->request->allowMethod(['post', 'aprobar']);
        $facturas = $this->Facturas->find('all')->where(['desde >='=>$date]);
        if($facturas->isEmpty())
        {
            $this->Flash->error(__('Los registros de facturación son muy pocos o incompletos.'));
            return $this->redirect($this->referer());
        }else
        {
            foreach ($facturas as $factura)
            {
                $factura->balance=$factura->balance;
                $this->Facturas->save($factura);
            }
        }
        $this->Flash->success(__('Las facturación del mes ha sido aprobada'));
        return $this->redirect($this->referer());
    }
}
