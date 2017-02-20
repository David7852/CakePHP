<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Articulos Controller
 *
 * @property \App\Model\Table\ArticulosTable $Articulos
 */
class ArticulosController extends AppController
{
    public function getRelated($id)
    {
        if($id==null)
            return null;
        $articulo = $this->Articulos->get($id, [
            'contain' => ['Modelos']
        ]);
        return $articulo;
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function inventario($dato = null)
    {
        $choice=$dato[0];
        if($choice=='0'||$choice=='1'||$choice=='2')
            $dato=substr($dato, 1);
        $this->paginate = ['contain' => ['Modelos']];
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $articulos=array();
            $models=TableRegistry::get('Modelos')->find('all')
                ->where(['tipo_de_articulo ='=>$dato]);
            foreach ($models as $m)            {
                $art = TableRegistry::get('Articulos')->find('all')
                ->where(['modelo_id ='=>$m->id]);
                foreach ($art as $iculos)                {
                    $asig = TableRegistry::get('Asignaciones')->find('all')->where(['articulo_id =' => $iculos->id])->andWhere(['hasta >=' => date('Y-m-d')]);
                    foreach ($asig as $row)                    {
                        $pro_tra = TableRegistry::get('ProcesosTrabajadores')->find('all')->where(['proceso_id =' => $row->proceso_id])->andWhere(['trabajador_id =' => $this->request->session()->read('Auth.User.trabajador_id')])->andWhere(['rol =' => 'Solicitante']);
                        if($pro_tra!=null&&!$pro_tra->isEmpty())
                            array_push($articulos, $iculos->id);
                    }
                }
            }
            if(empty($articulos)){
                $this->Flash->error(__('Usted no tiene Celulares asignados.'));
                return $this->redirect($this->referer());
            }
            $articulos = $this->paginate($this->Articulos->find('all',array('conditions'=>array('Articulos.id IN'=>$articulos))));
        }elseif($choice==0)        {
            $mo = array();
            $models = TableRegistry::get('Modelos')->find('all')->where(['tipo_de_articulo LIKE' => $dato.'%']);
            foreach ($models as $m)
                array_push($mo, $m->id);
            if (!empty($mo))
                $articulos = $this->paginate($this->Articulos->find('all', array('conditions' => array('Articulos.modelo_id IN' => $mo))));
            else
                $articulos = array();
            if(substr($dato, -1)=="s")
                $dato=$dato;
            elseif(substr($dato, -1)=="a"||substr($dato, -1)=="e"||substr($dato, -1)=="i"||substr($dato, -1)=="o"||substr($dato, -1)=="u")
                $dato=$dato."s";
            elseif(substr($dato, -1)=="z")
                $dato=substr($dato,0, -1)."ces";
            else
                $dato=$dato."es";
        }elseif($choice==1)        {
            $articulos = $this->paginate($this->Articulos->find('all')
                ->where(['serial LIKE'=>$dato.'%']));
            if($articulos->isEmpty())
                $articulos=array();
            $dato='Coincidencias con el serial "'.$dato.'"';
        }elseif($choice==2)        {
            $ids=array();
            $art = TableRegistry::get('Articulos')->find('all');
            foreach ($art as $iculos)
                if(similar_text($iculos->asignado,$dato)>=(strlen($dato)-strlen($dato)/4))//
                    array_push($ids,$iculos->id);
            if (!empty($ids))
                $articulos = $this->paginate($this->Articulos->find('all', array('conditions' => array('Articulos.id IN' => $ids))));
            else
                $articulos = array();
            $dato='Articulos de "'.$dato.'"';
        }
        $this->set(compact('articulos','modelos','dato'));
        $this->set('_serialize', ['articulos']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = ['contain' => ['Modelos']];
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $articulos=array();
            $art=TableRegistry::get('Articulos')->find('all');
            foreach ($art as $iculos){
                $asig=TableRegistry::get('Asignaciones')->find('all')
                    ->where(['articulo_id ='=>$iculos->id])
                    ->andWhere(['hasta >='=>date('Y-m-d')]);
                foreach ($asig as $row){
                    $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
                        ->where(['proceso_id ='=>$row->proceso_id])
                        ->andWhere(['trabajador_id ='=>$this->request->session()->read('Auth.User.trabajador_id')])
                        ->andWhere(['rol ='=>'Solicitante']);
                    if($pro_tra!=null&&!$pro_tra->isEmpty()){
                        array_push($articulos, $iculos->id);
                    }
                }
            }
            if(empty($articulos)){
                $this->Flash->error(__('Usted no tiene Articulos asignados.'));
                return $this->redirect($this->referer());
            }
            $articulos = $this->paginate($this->Articulos->find('all',array('conditions'=>array('Articulos.id IN'=>$articulos))));

        }else
            $articulos = $this->paginate($this->Articulos);
        $this->set(compact('articulos','modelos'));
        $this->set('_serialize', ['articulos']);
    }


    /**
     * View method
     *
     * @param string|null $id Articulo id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $asig=TableRegistry::get('Asignaciones')->find('all')
                ->where(['articulo_id ='=>$id])
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
        $articulo = $this->Articulos->get($id, [
            'contain' => ['Modelos', 'Accesorios', 'Asignaciones', 'Devoluciones', 'Lineas']
        ]);

        $this->set('articulo', $articulo);
        $this->set('_serialize', ['articulo']);
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
        $articulo = $this->Articulos->newEntity();
        if ($this->request->is('post')) {
            $articulo = $this->Articulos->patchEntity($articulo, $this->request->data);
            if ($this->Articulos->save($articulo)) {
                $this->Flash->success(__('El articulo ha sido guardado.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El articulo no pudo guardarse. Intente nuevamente.'));
            }
        }
        $modelos = $this->Articulos->Modelos->find('list', ['limit' => 500]);
        $this->set(compact('articulo', 'modelos'));
        $this->set('_serialize', ['articulo']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Articulo id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
        $articulo = $this->Articulos->get($id, [
            'contain' => ['Modelos', 'Accesorios']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $articulo = $this->Articulos->patchEntity($articulo, $this->request->data);
            if ($this->Articulos->save($articulo)) {
                $this->Flash->success(__('Los cambios en el articulo fueron guardados.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Los cambios en el articulo no pudieron guardarse. Intente nuevamente.'));
            }
        }
        $modelos = $this->Articulos->Modelos->find('list', ['limit' => 500]);
        $this->set(compact('articulo', 'modelos'));
        $this->set('_serialize', ['articulo']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Articulo id.
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
        $articulo = $this->Articulos->get($id);
        if ($this->Articulos->delete($articulo)) {
            $this->Flash->success(__('El articulo fue eliminado.'));
        } else {
            $this->Flash->error(__('El articulo no pudo eliminarse. Intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
