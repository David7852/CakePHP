<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
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
        $this->Auth->allow(['logout','add']);
    }

    /**
     * Logout  method
     *
     *
     */
    public function logout()
    {
        $this->Flash->success('Has cerrado seccion.');
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Login  method
     *
     *
     */
    public function login()
    {
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
