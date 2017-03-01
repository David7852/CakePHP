<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Routing\Router;
use Cake\ORM\TableRegistry;
/**
 * Trabajadores Controller
 *
 * @property \App\Model\Table\TrabajadoresTable $Trabajadores
 */
class TrabajadoresController extends AppController
{

    public function getRelated($id)
    {
        if($id==null)
            return null;
        $trabajador = $this->Consumos->get($id, [
            'contain' => ['Contratos', 'Usuarios', 'Procesos']
        ]);
        return $trabajador;
    }

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['nuevo']);
        $this->set('title', 'Usuarios');
    }

    public function busqueda($dato = null)
    {
        $ids=array();
        $t = TableRegistry::get('Trabajadores')->find('all');
        $choice=$dato[0];
        $trabajadores=array();
        if($choice=='0'||$choice=='1'||$choice=='2')
            $dato=substr($dato, 1);
        if($choice=='0'||$choice=='1')
        {
            foreach ($t as $rabajador)
            {
                $fullname = $rabajador->nombre. ' ' .$rabajador->apellido;
                if ((similar_text($rabajador->nombre, $dato) >= (strlen($dato) - strlen($dato) / 4))||
                    (similar_text($rabajador->apellido, $dato) >= (strlen($dato) - strlen($dato) / 4))||
                    (similar_text($fullname, $dato) >= (strlen($dato) - strlen($dato) / 4)))//
                    array_push($ids, $rabajador->id);
            }
            if (!empty($ids))
                $trabajadores = $this->paginate($this->Trabajadores->find('all', array('conditions' => array('Trabajadores.id IN' => $ids))));
            else
                $trabajadores = array();
        }elseif($choice=='2'){
            foreach ($t as $rabajador)
            {
                if ((similar_text($rabajador->gerencia, $dato) >= (strlen($dato) - strlen($dato) / 4))||
                    (similar_text($rabajador->cargo, $dato) >= (strlen($dato) - strlen($dato) / 4))||
                    (similar_text($rabajador->area, $dato) >= (strlen($dato) - strlen($dato) / 4)))//
                    array_push($ids, $rabajador->id);
            }
            if (!empty($ids))
                $trabajadores = $this->paginate($this->Trabajadores->find('all', array('conditions' => array('Trabajadores.id IN' => $ids))));
            else
                $trabajadores = array();
        }
        $this->set(compact('trabajadores','choice','dato'));
        $this->set('_serialize', ['trabajadores']);
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($dato = null)
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante'||$this->request->session()->read('Auth.User.funcion')=='Operador') {
            $trabajador = TableRegistry::get('Trabajadores')->get(($this->request->session()->read('Auth.User.trabajador_id')));
            $gerencia=$trabajador->gerencia;
            $cargo=$trabajador->cargo;
            if($cargo=="Gerente"||$cargo=="Supervisor"||$cargo=="Superintendente")            {
                $trabajadores=array();
                $trabajador = TableRegistry::get('Trabajadores')->find('all')->where(['gerencia ='=>$gerencia]);
                foreach ($trabajador as $t)
                    array_push($trabajadores, $t->id);
                if(!empty($trabajadores))
                    $trabajadores = $this->paginate($this->Trabajadores->find('all',array('conditions'=>array('Trabajadores.id IN'=>$trabajadores))));
                else {
                    $this->Flash->error(__('Usted no tiene empleados a su cargo.'));
                    return $this->redirect($this->referer());
                }
            }else {
                $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
                return $this->redirect($this->referer());
            }
        }elseif($dato !=null)        {
            $ids=array();
            $t = TableRegistry::get('Trabajadores')->find('all');
            foreach ($t as $rabajador)  {
                $fullname = $rabajador->nombre. ' ' .$rabajador->apellido;
                if ((similar_text($rabajador->nombre, $dato) >= (strlen($dato) - strlen($dato) / 4))||
                    (similar_text($rabajador->apellido, $dato) >= (strlen($dato) - strlen($dato) / 4))||
                    (similar_text($fullname, $dato) >= (strlen($dato) - strlen($dato) / 4)))//
                    array_push($ids, $rabajador->id);
            }
            if (!empty($ids))
                $trabajadores = $this->paginate($this->Trabajadores->find('all', array('conditions' => array('Trabajadores.id IN' => $ids))));
            else
                $trabajadores = array();
        }
        else
            $trabajadores = $this->paginate($this->Trabajadores);
        $this->set(compact('trabajadores'));
        $this->set('_serialize', ['trabajadores']);
    }

    /**
     * View method
     *
     * @param string|null $id Trabajador id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if(($this->request->session()->read('Auth.User.funcion')=='Visitante'||$this->request->session()->read('Auth.User.funcion')=='Operador')&&$this->request->session()->read('Auth.User.trabajador_id')!=$id) {
            $trabajador = TableRegistry::get('Trabajadores')->get(($this->request->session()->read('Auth.User.trabajador_id')));
            $gerencia=$trabajador->gerencia;
            $cargo=$trabajador->cargo;
            if($cargo=="Gerente"||$cargo=="Supervisor"||$cargo=="Superintendente")
            {
                $trabajador = TableRegistry::get('Trabajadores')->find('all')
                    ->where(['gerencia ='=>$gerencia])
                    ->andWhere(['id ='=>$id]);
                if($trabajador->isEmpty()||
                    $trabajador->first()->cargo=='Gerente'||
                    ($trabajador->first()->cargo=='Supervisor'&&$cargo!='Gerente')||
                    ($trabajador->first()->cargo=='Superintendente'&&$cargo!='Gerente'))
                {
                    $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
                    return $this->redirect($this->referer());
                }
            }else {
                $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
                return $this->redirect($this->referer());
            }
        }
        $trabajador = $this->Trabajadores->get($id, [
            'contain' => ['Procesos', 'Contratos', 'Usuarios']
        ]);

        $this->set('trabajador', $trabajador);
        $this->set('_serialize', ['trabajador']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if($this->request->session()->read('Auth.User.funcion')=='Visitante'||
            $this->request->session()->read('Auth.User.funcion')=='Operador') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
        $trabajador = $this->Trabajadores->newEntity();
        if ($this->request->is('post')) {
            $trabajador = $this->Trabajadores->patchEntity($trabajador, $this->request->data);
            if ($this->Trabajadores->save($trabajador)) {
                $this->Flash->success(__('El trabajador ha sido registrado.'));
                $contrato=TableRegistry::get('Contratos')->newEntity();
                $contrato=TableRegistry::get('Contratos')->patchEntity($contrato,
                [
                    'trabajador_id'=>$trabajador->id,
                    'fecha_de_inicio'=>date('Y-m-d'),
                    'tipo_de_contrato'=>'Temporal',
                ]);
                if(!TableRegistry::get('Contratos')->save($contrato))
                    $this->Flash->error('El intento de registrar el contrato para este trabajador fallo.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El trabajador no pudo ser guardado. Intente nuevamente.'));
            }
        }
        $procesos = $this->Trabajadores->Procesos->find('list', ['limit' => 500]);
        $this->set(compact('trabajador', 'procesos'));
        $this->set('_serialize', ['trabajador']);
    }
    protected function getnewname($username)    {
        $user = TableRegistry::get('Usuarios');
        $q = $user->find();
        $c = 2;
        $bol = true;
        while ($bol) {
            $bol = false;
            foreach ($q as $row)
                if ($row->nombre_de_usuario == $username . $c)  {
                    $c++;
                    $bol = true;
                }
        }
        if($c==2)
            return $username;
        return $username.$c;
    }
    /**
     * New method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function nuevo()
    {
        $this->paginate = [
            'contain' => ['Usuarios']
        ];
        $trabajador = $this->Trabajadores->newEntity();
        if ($this->request->is('post')) {
            $trabajador = $this->Trabajadores->patchEntity($trabajador, $this->request->data);
            if ($this->Trabajadores->save($trabajador)) {
                $this->Flash->success(__('¡Bienvenido! Su registro como trabajador de FertiNitro ha sido un exito.'));
                $contrato=TableRegistry::get('Contratos')->newEntity();
                $contrato=TableRegistry::get('Contratos')->patchEntity($contrato,
                    [
                        'trabajador_id'=>$trabajador->id,
                        'fecha_de_inicio'=>date('Y-m-d'),
                        'tipo_de_contrato'=>'Temporal',
                    ]);
                if(!TableRegistry::get('Contratos')->save($contrato))
                    $this->Flash->error('El intento de registrar el contrato para este trabajador fallo.');
                $usuario = TableRegistry::get('Usuarios')->newEntity();
                $username=$this->request->data['apellido'].$this->request->data['nombre'][0];
                $username=$this->getnewname($username);
                $usuario = TableRegistry::get('Usuarios')->patchEntity($usuario,
                    ['nombre_de_usuario'=>$username,
                        'email'=>$username.'@fertinitro.com',
                        'clave'=>$this->request->data['cedula'],
                        'funcion'=>'Visitante',
                        'trabajador_id'=>$trabajador->id]);
                if (TableRegistry::get('Usuarios')->save($usuario)) {
                    $this->Flash->success(__('Adicionalmente, Un nuevo nombre de usuario fue creado para usted: '.$usuario->nombre_de_usuario));
                    $this->Auth->setUser($usuario);
                    return $this->redirect(['controller'=>'Usuarios', 'action' => 'view',$usuario->id]);
                }else{
                    $this->Flash->error(__('Usted es un trabajador registrado, pero el intento de crear su usuario fallo. Contacte a IT soporte.'));
                    return $this->redirect(['action' => 'view',$trabajador->id]);
                }
            } else {
                $this->Flash->error(__('Usted no pudo ser registrado. Intente nuevamente.'));
            }
        }
        $procesos = $this->Trabajadores->Procesos->find('list', ['limit' => 500]);
        $this->set(compact('trabajador', 'procesos'));
        $this->set('_serialize', ['trabajador']);
    }
    /**
     * Edit method
     *
     * @param string|null $id Trabajador id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if(($this->request->session()->read('Auth.User.funcion')=='Visitante'||
                $this->request->session()->read('Auth.User.funcion')=='Operador')&&
                $this->request->session()->read('Auth.User.trabajador_id')!=$id) {
            $trabajador = TableRegistry::get('Trabajadores')->get(($this->request->session()->read('Auth.User.trabajador_id')));
            $gerencia=$trabajador->gerencia;
            $cargo=$trabajador->cargo;
            if($cargo=="Gerente"||$cargo=="Supervisor"||$cargo=="Superintendente")
            {
                $trabajador = TableRegistry::get('Trabajadores')->find('all')
                    ->where(['gerencia ='=>$gerencia])
                    ->andWhere(['id ='=>$id]);
                if($trabajador->isEmpty()||
                    $trabajador->first()->cargo=='Gerente'||
                    ($trabajador->first()->cargo=='Supervisor'&&$cargo!='Gerente')||
                    ($trabajador->first()->cargo=='Superintendente'&&$cargo!='Gerente'))
                {
                    $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
                    return $this->redirect($this->referer());
                }
            }else {
                $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
                return $this->redirect($this->referer());
            }
        }
        $trabajador = $this->Trabajadores->get($id, [
            'contain' => ['Procesos']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $trabajador = $this->Trabajadores->patchEntity($trabajador, $this->request->data);
            if ($this->Trabajadores->save($trabajador)) {
                $this->Flash->success(__('Los cambios en el trabajador fueron guardados.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Los cambios en el trabajador no pudieron guardarse. Intente nuevamente.'));
            }
        }
        $procesos = $this->Trabajadores->Procesos->find('list', ['limit' => 500]);
        $this->set(compact('trabajador', 'procesos'));
        $this->set('_serialize', ['trabajador']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Trabajador id.
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
        $trabajador = $this->Trabajadores->get($id);
        if ($this->Trabajadores->delete($trabajador)) {
            $this->Flash->success(__('Se ha eliminado correctamente al trabajador.'));
        } else {
            $this->Flash->error(__('El trabajador no pudo eliminarse. Intente nuevamente.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
