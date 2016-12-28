<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;use Cake\Routing\Router;

use Cake\ORM\TableRegistry;
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
        $this->Auth->allow(['logout','add','signup']);
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
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('El nombre de usuario o contraseña son incorrectos.');
        }
    }
    /**
     * Signing up medthod
     *
     *
     */
    public function signup()
    {/*

    IMPORTANT. SINCE THE CONTROLLER WILL EVENTUALLY BLOCK VISITOR AND UNAUTHORIZED USER TO ACCESS OTHER PROFILES, AN
    UNIVERSAL ACCESSOR MUST BE GIVEN FOR CAKE LEVEL ACTIONS. THIS CREDENTIAL MUST BE HIDDEN.

    */
        if ($this->request->is('post'))
        {
            $trabajadores = TableRegistry::get('Trabajadores');
            $query = $trabajadores->find();
            $found=false;
            $userid=-1;
            foreach ($query as $row)
                if( $row->cedula==$this->request->data['cedula'])//if a worker with this ci exits...
                {
                    $found = true;
                    $usuarios = TableRegistry::get('Usuarios');
                    $query = $usuarios->find();
                    foreach ($query as $userrow)
                    {
                        if($userrow->trabajador_id==$row->id)//and if at least an user happens to belong to said worker
                        {
                            //redirect to the view of that user.
                        }
                    }
                    //but if there are no users belonging to said worker
                    //search for an user which username is equal to lastname and first latter of name of worker,
                    // if no results are found, create said user an redirect to its view.
                    break;
                }
            if ($found) {
                $this->Flash->success(__('Un trabajador con la cédula ' .$this->request->data['cedula'].' esta presente.'));

                $url = array('controller' => 'usuarios', 'action' => 'login');
                $second = '1.25';
                $this->response->header("refresh:$second; url='" . Router::url($url) . "'");
                $this->set(compact('url', 'second'));
            } else {
                $this->Flash->error(__('El nuevo usuario no pudo ser guardado. Intente nuevamente.'));
            }
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
            'contain' => []
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
