<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Routing\Router;
use Cake\ORM\TableRegistry;
use PhpParser\Node\Stmt\Else_;

/**
 * Usuarios Controller
 *
 * @property \App\Model\Table\UsuariosTable $Usuarios
 */
class UsuariosController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['logout','signup','reset']);
        $this->set('title', 'Usuarios');
    }

    /**
     * Logout  method
     *
     *
     */
    public function logout()
    {
        $this->Flash->success('Has cerrado sesion.');
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Login  method
     *
     *
     */
    public function login()
    {
        if($this->request->session()->read('Auth.User'))
            return $this->redirect(['action' => 'view', $this->request->session()->read('Auth.User.id')]);
        if($this->request->is('post'))
            if (array_key_exists('btn',$this->request->data)&&$this->request->data['btn'] == 'Ingresar') {
                $user = $this->Auth->identify();
                if ($user) {
                    $this->Auth->setUser($user);
                    return $this->redirect($this->Auth->redirectUrl());
                }
                $this->Flash->error('El nombre de usuario o contraseña son incorrectos.');
            }else
            {
                $usuarios = TableRegistry::get('Usuarios');
                $query = $usuarios->find();
                $found=false;
                foreach ($query as $userrow){
                    if($userrow->nombre_de_usuario==$this->request->data['nombre_de_usuario'])
                        $found=$userrow->id;
                }
                if($found)
                {
                    return $this->redirect(['action' => 'reset',$found]);
                }
                $this->Flash->error('Ningun nombre de usuario coincide con el nombre ingresado');
            }
    }

    protected function getnewname($username)
    {
        /*
         * receive the desire username that causes conflict with the naming standard.
         */
        $user = TableRegistry::get('Usuarios');
        $q = $user->find();
        $c = 2;
        $bol = true;
        while ($bol)
        {
            $bol = false;
            foreach ($q as $row)
                if ($row->nombre_de_usuario == $username . $c)
                {
                    $c++;
                    $bol = true;
                }
        }
        return $username.$c;
    }
    protected function lastnamefixer($lastname)
    {
        return  strtok($lastname, " ");
    }
    /**
     * Signing up medthod
     *
     *
     */
    public function signup()
    {
        if($this->request->session()->read('Auth.User'))
            return $this->redirect(['action' => 'view', $this->request->session()->read('Auth.User.id')]);
        if ($this->request->is('post'))
        {
            $trabajadores = TableRegistry::get('Trabajadores');
            $query = $trabajadores->find();
            $found=false;
            foreach ($query as $row)
                if( $row->cedula==$this->request->data['cedula']){//if a worker with this ci exits...
                    $usuarios = TableRegistry::get('Usuarios');
                    $query = $usuarios->find();
                    foreach ($query as $userrow){
                        if($userrow->trabajador_id==$row->id){//and if at least an user happens to belong to said worker redirect to the view of that user.
                            $this->Flash->success(__('Trabajador y usuario encontrados. Redireccionando...'));
                            $url = array('controller' => 'usuarios', 'action' => 'view',$userrow->id);//an special action can be created so that it displays flashes with instructions
                            $second = '1.25';
                            $this->Auth->setUser($usuarios->get($userrow->id));
                            $this->response->header("refresh:$second; url='" . Router::url($url) . "'");
                            $this->set(compact('url', 'second'));
                            return;
                        }//but if there are no users belonging to said worker, one should be prepared and created for it... first, search for an user which username is equal to last name and first latter of name.
                        if(!$found&&$userrow->nombre_de_usuario==$this->lastnamefixer($row->apellido).$row->nombre[0])//if a result is found, it means there is a coincidence of names and the default naming rule for users can't be applied, thus an alternative name should be generated. (append number)
                            $found=$this->getnewname($userrow->nombre_de_usuario);
                    }
                    $usuario = $this->Usuarios->newEntity();
                    if(!$found){
                        // if no coincidence is found, create an user with the default rule and redirect to its view.
                        $found=$this->lastnamefixer($row->apellido).$row->nombre[0];
                        $usuario = $this->Usuarios->patchEntity($usuario,
                            ['nombre_de_usuario'=>$found,
                                'email'=>$found.'@fertinitro.com',
                                'clave'=>$row->cedula,
                                'funcion'=>'Visitante',
                                'trabajador_id'=>$row->id]);
                    }else
                        $usuario = $this->Usuarios->patchEntity($usuario,
                            ['nombre_de_usuario'=>$found,
                                'email'=>$found.'@fertinitro.com',
                                'clave'=>$row->cedula,
                                'funcion'=>'Visitante',
                                'trabajador_id'=>$row->id]);
                    if ($this->Usuarios->save($usuario)) {//if user could be inserted, echo message and redirect
                        $this->Flash->success(__('Un nuevo nombre de usuario fue creado para usted: '.$usuario->nombre_de_usuario));
                        $this->Auth->setUser($usuario);
                        return $this->redirect(['action' => 'view',$usuario->id]);
                    } else //else, echo sorry message
                        $this->Flash->error(__('Usted es un trabajador registrado, pero el intento de crear su usuario fallo. Contacte a IT soporte.'));
                    break;
                }//if no worker found with such ci, echo
            $this->Flash->error(__('Ningún trabajador fue previamente registrado con esa cédula. por favor, registrese.'));
        }
    }

    /**
     * Reset method
     *
     *
     */
    public function reset($id = null)
    {
        if($this->request->session()->read('Auth.User'))
            return $this->redirect(['action' => 'view', $this->request->session()->read('Auth.User.id')]);
        if ($this->request->is('post'))
        {
            $usuario = TableRegistry::get('Usuarios')->get($id);
            $trabajador = TableRegistry::get('Trabajadores')->get($usuario->id);
            if($this->request->data['nombre']==$trabajador->nombre&&$this->request->data['apellido']==$trabajador->apellido&&$this->request->data['cedula']==$trabajador->cedula)
            {
                $this->Flash->success(('clave restaurada, Intente ingresar con ..'));
                $usuario->clave='fertinitro';
                return $this->redirect(['action' => 'login']);
            }
            else
                return $this->Flash->error(('Los datos que ingreso no son correctos, su clave no pudo ser reiniciada'));
        }
    }

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
        $usuarios = $this->paginate($this->Usuarios);

        $this->set(compact('usuarios'));
        $this->set('_serialize', ['usuarios']);
    }

    /**
     * View method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usuario = $this->Usuarios->get($id, [
            'contain' => ['Trabajadores']
        ]);

        $this->set('usuario', $usuario);
        $this->set('_serialize', ['usuario']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if($this->request->session()->read('Auth.User.funcion')!='Administrador'&&$this->request->session()->read('Auth.User.funcion')!='Superadministrador') {
            $this->Flash->error(__('Usted no tiene permiso para acceder a la pagina solicitada.'));
            return $this->redirect($this->referer());
        }
        $usuario = $this->Usuarios->newEntity();
        if ($this->request->is('post')) {
            $usuario = $this->Usuarios->patchEntity($usuario, $this->request->data);
            if ($this->Usuarios->save($usuario)) {
                $this->Flash->success(__('El usuario a sido registrado.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El nuevo usuario no pudo ser guardado. Intente nuevamente.'));
            }
        }
        $trabajadores = $this->Usuarios->Trabajadores->find('list', ['limit' => 200]);
        $this->set(compact('usuario', 'trabajadores'));
        $this->set('_serialize', ['usuario']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usuario = $this->Usuarios->get($id, [
            'contain' => ['Trabajadores']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usuario = $this->Usuarios->patchEntity($usuario, $this->request->data);
            if ($this->Usuarios->save($usuario)) {
                $this->Flash->success(__('El usuario se modifico correctamente.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Los cambios no pudieron guardarse, Intente nuevamente.'));
            }
        }
        $trabajadores = $this->Usuarios->Trabajadores->find('list', ['limit' => 200]);
        $this->set(compact('usuario', 'trabajadores'));
        $this->set('_serialize', ['usuario']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usuario = $this->Usuarios->get($id);
        if ($this->Usuarios->delete($usuario)) {
            $this->Flash->success(__('El usuario ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El usuario no pudo eliminarse. Intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
