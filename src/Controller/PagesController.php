<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Routing\Router;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function display()
    {
        $path = func_get_args();

        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));
        if ($this->request->is('post')) {
            if (array_key_exists('tipobtn',$this->request->data)&&$this->request->data['tipo'] != null && $this->request->data['tipo'] != ' ')
                return $this->redirect(['controller' => 'Articulos', 'action' => 'inventario', '0'.$this->request->data['tipo']]);
            elseif (array_key_exists('serbtn',$this->request->data)&&$this->request->data['serial'] != null && $this->request->data['serial'] != ' ')
                return $this->redirect(['controller' => 'Articulos', 'action' => 'inventario', '1'.$this->request->data['serial']]);
            elseif (array_key_exists('artbyusebtn',$this->request->data)&&$this->request->data['artbyuse'] != null && $this->request->data['artbyuse'] != ' ')
                return $this->redirect(['controller' => 'Articulos', 'action' => 'inventario', '2'.$this->request->data['artbyuse']]);
            elseif (array_key_exists('nombrebtn',$this->request->data)&&$this->request->data['nombre'] != null && $this->request->data['nombre'] != ' ')
                return $this->redirect(['controller' => 'Trabajadores', 'action' => 'busqueda', '0'.$this->request->data['nombre']]);
            elseif (array_key_exists('numerobtn',$this->request->data)&&$this->request->data['numero'] != null && $this->request->data['numero'] != ' ')
                return $this->redirect(['controller' => 'Trabajadores', 'action' => 'busqueda', '1'.$this->request->data['numero']]);
            elseif (array_key_exists('gerbtn',$this->request->data)&&$this->request->data['gerencia'] != null && $this->request->data['gerencia'] != ' ')
                return $this->redirect(['controller' => 'Trabajadores', 'action' => 'busqueda', '2'.$this->request->data['gerencia']]);
        }
        try {
            if(!$this->request->session()->read('Auth.User')&&$page!='home'){
                return $this->redirect(['controller'=>'Usuarios', 'action' => 'login']);
            }
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }
    }
}
