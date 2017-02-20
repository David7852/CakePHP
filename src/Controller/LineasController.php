<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Lineas Controller
 *
 * @property \App\Model\Table\LineasTable $Lineas
 */
class LineasController extends AppController
{

    public function getRelated($id)
    {
        if($id==null)
            return null;
        $linea = $this->Lineas->get($id, [
            'contain' => ['Articulos', 'Rentas', 'Facturas']
        ]);
        return $linea;
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($id = null)
    {
        $this->paginate = [
            'contain' => ['Articulos']
        ];
        if($this->request->session()->read('Auth.User.funcion')=='Visitante'||$id != null)
        {
            $lineas=array();
            $lin=TableRegistry::get('Lineas')->find('all');
            foreach ($lin as $eas){

                $asig=TableRegistry::get('Asignaciones')->find('all')
                    ->where(['articulo_id ='=>$eas->articulo_id])
                    ->andWhere(['hasta >='=>date('Y-m-d')]);
                foreach ($asig as $row){
                    $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
                        ->where(['proceso_id ='=>$row->proceso_id])
                        ->andWhere(['trabajador_id ='=>$this->request->session()->read('Auth.User.trabajador_id')])
                        ->andWhere(['rol ='=>'Solicitante']);;
                    if($pro_tra!=null&&!$pro_tra->isEmpty())
                        array_push($lineas, $eas->id);
                }
            }
            if(empty($lineas)){
                $this->Flash->error(__('Usted no tiene Lineas asignadas.'));
                return $this->redirect($this->referer());
            }
            $lineas = $this->paginate($this->Lineas->find('all',array('conditions'=>array('Lineas.id IN'=>$lineas))));

        }else
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

        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $asig=TableRegistry::get('Asignaciones')->find('all')
                ->where(['articulo_id ='=>$this->Lineas->get($id)->articulo_id])
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
        $facturas=TableRegistry::get('Facturas')->find('all')->where(['linea_id ='=>$id])->andWhere(['desde >='=>date("Y-m").'-1']);
        $consumos=array();
        foreach ($facturas as $factura) {
            $consumo = TableRegistry::get('Consumos')->find('all')->where(['factura_id =' => $factura->id]);
            foreach ($consumo as $c)
                array_push($consumos, $c->id);
        }
        if(!empty($consumos)){
            $consumos = $this->paginate(TableRegistry::get('Consumos')->find('all',array('conditions'=>array('Consumos.id IN'=>$consumos))));

        }
        $linea = $this->Lineas->get($id, [
            'contain' => ['Articulos', 'Rentas', 'Facturas']
        ]);
        $this->set('linea', $linea);
        $this->set('consumos', $consumos);
        $this->set('_serialize', ['linea']);
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
        $s=array();
        $modelos=TableRegistry::get('Modelos')->find('all')
            ->where(['tipo_de_articulo ='=>'Celular']);
        if(!$modelos->isEmpty())
            foreach ($modelos as $mo)
                array_push($s,$mo->id);
        if(!empty($s))
            $articulos = $this->Lineas->Articulos->find('list', array('limit' => 500,'conditions'=>array('Articulos.modelo_id IN'=>$s)));//restringir para que solo muestre celulares o telefonos fijos
        else
            $articulos = $this->Lineas->Articulos->find('list', ['limit' => 500]);
        $rentas = $this->Lineas->Rentas->find('list', ['limit' => 500]);
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
        if($this->request->session()->read('Auth.User.funcion')!='Administrador'&&$this->request->session()->read('Auth.User.funcion')!='Superadministrador') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la accion solicitada.'));
            return $this->redirect($this->referer());
        }
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
        $s=array();
        $modelos=TableRegistry::get('Modelos')->find('all')
            ->where(['tipo_de_articulo ='=>'Celular']);
        if(!$modelos->isEmpty())
            foreach ($modelos as $mo)
                array_push($s,$mo->id);
        if(!empty($s))
            $articulos = $this->Lineas->Articulos->find('list', array('limit' => 500,'conditions'=>array('Articulos.modelo_id IN'=>$s)));//restringir para que solo muestre celulares o telefonos fijos
        else
            $articulos = $this->Lineas->Articulos->find('list', ['limit' => 500]);
        $rentas = $this->Lineas->Rentas->find('list', ['limit' => 500]);
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
        if($this->request->session()->read('Auth.User.funcion')!='Superadministrador') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la accion solicitada.'));
            return $this->redirect($this->referer());
        }
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
