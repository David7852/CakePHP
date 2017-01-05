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
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['nuevo']);
        $this->set('title', 'Usuarios');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $trabajadores = $this->paginate($this->Trabajadores);

        $this->set(compact('trabajadores'));
        $this->set('_serialize', ['trabajadores']);
    }

    public function menu()
    {
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
        $trabajador = $this->Trabajadores->newEntity();
        if ($this->request->is('post')) {
            $trabajador = $this->Trabajadores->patchEntity($trabajador, $this->request->data);
            if ($this->Trabajadores->save($trabajador)) {
                $this->Flash->success(__('El trabajador ha sido registrado.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El trabajador no pudo ser guardado. Intente nuevamente.'));
            }
        }
        $procesos = $this->Trabajadores->Procesos->find('list', ['limit' => 200]);
        $this->set(compact('trabajador', 'procesos'));
        $this->set('_serialize', ['trabajador']);
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
                $this->Flash->success(__('El trabajador ha sido registrado.'));


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
                    return $this->redirect(['action' => 'view',$usuario->id]);
                }else{
                    $this->Flash->error(__('Usted es un trabajador registrado, pero el intento de crear su usuario fallo. Contacte a IT soporte.'));
                    return $this->redirect(['action' => 'view',$trabajador->id]);
                }
            } else {
                $this->Flash->error(__('El trabajador no pudo ser guardado. Intente nuevamente.'));
            }
        }
        $procesos = $this->Trabajadores->Procesos->find('list', ['limit' => 200]);
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
        $procesos = $this->Trabajadores->Procesos->find('list', ['limit' => 200]);
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
