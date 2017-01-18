<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

//usuarios
Router::scope('/usuarios',['controller' => 'Usuarios'],function (RouteBuilder $routes) {    $routes->connect('/ver/*', ['action' => 'view']);});
Router::scope('/usuarios',['controller' => 'Usuarios'],function (RouteBuilder $routes) {    $routes->connect('/editar/*', ['action' => 'edit']);});
Router::scope('/usuarios',['controller' => 'Usuarios'],function (RouteBuilder $routes) {    $routes->connect('/nuevo/*', ['action' => 'add']);});
Router::scope('/usuarios',['controller' => 'Usuarios'],function (RouteBuilder $routes) {    $routes->connect('/listar/', ['action' => 'index']);});
Router::scope('/usuarios',['controller' => 'Usuarios'],function (RouteBuilder $routes) {    $routes->connect('/', ['action' => 'menu']);});
Router::scope('/usuarios',['controller' => 'Usuarios'],function (RouteBuilder $routes) {    $routes->connect('/ingresar/*', ['action' => 'login']);});
Router::scope('/usuarios',['controller' => 'Usuarios'],function (RouteBuilder $routes) {    $routes->connect('/salir', ['action' => 'logout']);});
Router::scope('/usuarios',['controller' => 'Usuarios'],function (RouteBuilder $routes) {    $routes->connect('/registrate', ['action' => 'signup']);});
Router::scope('/usuarios',['controller' => 'Usuarios'],function (RouteBuilder $routes) {    $routes->connect('/reiniciar/*', ['action' => 'reset']);});
//trabajadores
Router::scope('/trabajadores',['controller' => 'Trabajadores'],function (RouteBuilder $routes) {    $routes->connect('/ver/*', ['action' => 'view']);});
Router::scope('/trabajadores',['controller' => 'Trabajadores'],function (RouteBuilder $routes) {    $routes->connect('/editar/*', ['action' => 'edit']);});
Router::scope('/trabajadores',['controller' => 'Trabajadores'],function (RouteBuilder $routes) {    $routes->connect('/nuevo/*', ['action' => 'add']);});
Router::scope('/trabajadores',['controller' => 'Trabajadores'],function (RouteBuilder $routes) {    $routes->connect('/listar/', ['action' => 'index']);});
Router::scope('/trabajadores',['controller' => 'Trabajadores'],function (RouteBuilder $routes) {    $routes->connect('/bienvenido/', ['action' => 'nuevo']);});
Router::scope('/trabajadores',['controller' => 'Trabajadores'],function (RouteBuilder $routes) {    $routes->connect('/', ['action' => 'menu']);});
//Servicios
Router::scope('/servicios',['controller' => 'Servicios'],function (RouteBuilder $routes) {    $routes->connect('/ver/*', ['action' => 'view']);});
Router::scope('/servicios',['controller' => 'Servicios'],function (RouteBuilder $routes) {    $routes->connect('/editar/*', ['action' => 'edit']);});
Router::scope('/servicios',['controller' => 'Servicios'],function (RouteBuilder $routes) {    $routes->connect('/nuevo/*', ['action' => 'add']);});
Router::scope('/servicios',['controller' => 'Servicios'],function (RouteBuilder $routes) {    $routes->connect('/listar/', ['action' => 'index']);});
Router::scope('/servicios',['controller' => 'Servicios'],function (RouteBuilder $routes) {    $routes->connect('/', ['action' => 'menu']);});
//Rentas
Router::scope('/rentas',['controller' => 'Rentas'],function (RouteBuilder $routes) {    $routes->connect('/ver/*', ['action' => 'view']);});
Router::scope('/rentas',['controller' => 'Rentas'],function (RouteBuilder $routes) {    $routes->connect('/editar/*', ['action' => 'edit']);});
Router::scope('/rentas',['controller' => 'Rentas'],function (RouteBuilder $routes) {    $routes->connect('/nuevo/*', ['action' => 'add']);});
Router::scope('/rentas',['controller' => 'Rentas'],function (RouteBuilder $routes) {    $routes->connect('/listar/', ['action' => 'index']);});
Router::scope('/rentas',['controller' => 'Rentas'],function (RouteBuilder $routes) {    $routes->connect('/', ['action' => 'menu']);});
//procesos
Router::scope('/procesos',['controller' => 'Procesos'],function (RouteBuilder $routes) {    $routes->connect('/ver/*', ['action' => 'view']);});
Router::scope('/procesos',['controller' => 'Procesos'],function (RouteBuilder $routes) {    $routes->connect('/editar/*', ['action' => 'edit']);});
Router::scope('/procesos',['controller' => 'Procesos'],function (RouteBuilder $routes) {    $routes->connect('/nuevo/*', ['action' => 'add']);});
Router::scope('/procesos',['controller' => 'Procesos'],function (RouteBuilder $routes) {    $routes->connect('/listar/', ['action' => 'index']);});
Router::scope('/procesos',['controller' => 'Procesos'],function (RouteBuilder $routes) {    $routes->connect('/solicitar/*', ['action' => 'solicitar']);});
Router::scope('/solicitar',['controller' => 'Procesos'],function (RouteBuilder $routes) {    $routes->connect('/', ['action' => 'solicitar']);});
Router::scope('/asociarequipo',['controller' => 'Procesos'],function (RouteBuilder $routes) {    $routes->connect('/', ['action' => 'asociarequipo']);});
Router::scope('/devolverequipo',['controller' => 'Procesos'],function (RouteBuilder $routes) {    $routes->connect('/', ['action' => 'devolverequipo']);});
Router::scope('/procesos',['controller' => 'Procesos'],function (RouteBuilder $routes) {    $routes->connect('/', ['action' => 'menu']);});
//modelos
Router::scope('/modelos',['controller' => 'Modelos'],function (RouteBuilder $routes) {    $routes->connect('/ver/*', ['action' => 'view']);});
Router::scope('/modelos',['controller' => 'Modelos'],function (RouteBuilder $routes) {    $routes->connect('/editar/*', ['action' => 'edit']);});
Router::scope('/modelos',['controller' => 'Modelos'],function (RouteBuilder $routes) {    $routes->connect('/nuevo/*', ['action' => 'add']);});
Router::scope('/modelos',['controller' => 'Modelos'],function (RouteBuilder $routes) {    $routes->connect('/listar/', ['action' => 'index']);});
Router::scope('/modelos',['controller' => 'Modelos'],function (RouteBuilder $routes) {    $routes->connect('/', ['action' => 'menu']);});
//lineas
Router::scope('/lineas',['controller' => 'Lineas'],function (RouteBuilder $routes) {    $routes->connect('/ver/*', ['action' => 'view']);});
Router::scope('/lineas',['controller' => 'Lineas'],function (RouteBuilder $routes) {    $routes->connect('/editar/*', ['action' => 'edit']);});
Router::scope('/lineas',['controller' => 'Lineas'],function (RouteBuilder $routes) {    $routes->connect('/nuevo/*', ['action' => 'add']);});
Router::scope('/lineas',['controller' => 'Lineas'],function (RouteBuilder $routes) {    $routes->connect('/listar/', ['action' => 'index']);});
Router::scope('/lineas',['controller' => 'Lineas'],function (RouteBuilder $routes) {    $routes->connect('/', ['action' => 'menu']);});
//facturas
Router::scope('/facturas',['controller' => 'Facturas'],function (RouteBuilder $routes) {    $routes->connect('/ver/*', ['action' => 'view']);});
Router::scope('/facturas',['controller' => 'Facturas'],function (RouteBuilder $routes) {    $routes->connect('/editar/*', ['action' => 'edit']);});
Router::scope('/facturas',['controller' => 'Facturas'],function (RouteBuilder $routes) {    $routes->connect('/nuevo/*', ['action' => 'add']);});
Router::scope('/facturas',['controller' => 'Facturas'],function (RouteBuilder $routes) {    $routes->connect('/listar/', ['action' => 'index']);});
Router::scope('/facturas',['controller' => 'Facturas'],function (RouteBuilder $routes) {    $routes->connect('/', ['action' => 'menu']);});
//devoluciones
Router::scope('/devoluciones',['controller' => 'Devoluciones'],function (RouteBuilder $routes) {    $routes->connect('/ver/*', ['action' => 'view']);});
Router::scope('/devoluciones',['controller' => 'Devoluciones'],function (RouteBuilder $routes) {    $routes->connect('/editar/*', ['action' => 'edit']);});
Router::scope('/devoluciones',['controller' => 'Devoluciones'],function (RouteBuilder $routes) {    $routes->connect('/nuevo/*', ['action' => 'add']);});
Router::scope('/devoluciones',['controller' => 'Devoluciones'],function (RouteBuilder $routes) {    $routes->connect('/asociar/*', ['action' => 'asociar']);});
Router::scope('/devoluciones',['controller' => 'Devoluciones'],function (RouteBuilder $routes) {    $routes->connect('/listar/', ['action' => 'index']);});
Router::scope('/devoluciones',['controller' => 'Devoluciones'],function (RouteBuilder $routes) {    $routes->connect('/', ['action' => 'menu']);});
//contratos
Router::scope('/contratos',['controller' => 'Contratos'],function (RouteBuilder $routes) {    $routes->connect('/ver/*', ['action' => 'view']);});
Router::scope('/contratos',['controller' => 'Contratos'],function (RouteBuilder $routes) {    $routes->connect('/editar/*', ['action' => 'edit']);});
Router::scope('/contratos',['controller' => 'Contratos'],function (RouteBuilder $routes) {    $routes->connect('/nuevo/*', ['action' => 'add']);});
Router::scope('/contratos',['controller' => 'Contratos'],function (RouteBuilder $routes) {    $routes->connect('/listar/', ['action' => 'index']);});
Router::scope('/contratos',['controller' => 'Contratos'],function (RouteBuilder $routes) {    $routes->connect('/', ['action' => 'menu']);});
//consumos
Router::scope('/consumos',['controller' => 'Consumos'],function (RouteBuilder $routes) {    $routes->connect('/ver/*', ['action' => 'view']);});
Router::scope('/consumos',['controller' => 'Consumos'],function (RouteBuilder $routes) {    $routes->connect('/editar/*', ['action' => 'edit']);});
Router::scope('/consumos',['controller' => 'Consumos'],function (RouteBuilder $routes) {    $routes->connect('/nuevo/*', ['action' => 'add']);});
Router::scope('/consumos',['controller' => 'Consumos'],function (RouteBuilder $routes) {    $routes->connect('/listar/', ['action' => 'index']);});
Router::scope('/consumos',['controller' => 'Consumos'],function (RouteBuilder $routes) {    $routes->connect('/', ['action' => 'menu']);});
//asignaciones
Router::scope('/asignaciones',['controller' => 'Asignaciones'],function (RouteBuilder $routes) {    $routes->connect('/ver/*', ['action' => 'view']);});
Router::scope('/asignaciones',['controller' => 'Asignaciones'],function (RouteBuilder $routes) {    $routes->connect('/editar/*', ['action' => 'edit']);});
Router::scope('/asignaciones',['controller' => 'Asignaciones'],function (RouteBuilder $routes) {    $routes->connect('/nuevo/*', ['action' => 'add']);});
Router::scope('/asignaciones',['controller' => 'Asignaciones'],function (RouteBuilder $routes) {    $routes->connect('/asociar/*', ['action' => 'asociar']);});
Router::scope('/asignaciones',['controller' => 'Asignaciones'],function (RouteBuilder $routes) {    $routes->connect('/listar/', ['action' => 'index']);});
Router::scope('/asignaciones',['controller' => 'Asignaciones'],function (RouteBuilder $routes) {    $routes->connect('/', ['action' => 'menu']);});
//articulos
Router::scope('/articulos',['controller' => 'Articulos'],function (RouteBuilder $routes) {    $routes->connect('/ver/*', ['action' => 'view']);});
Router::scope('/articulos',['controller' => 'Articulos'],function (RouteBuilder $routes) {    $routes->connect('/editar/*', ['action' => 'edit']);});
Router::scope('/articulos',['controller' => 'Articulos'],function (RouteBuilder $routes) {    $routes->connect('/nuevo/*', ['action' => 'add']);});
Router::scope('/articulos',['controller' => 'Articulos'],function (RouteBuilder $routes) {    $routes->connect('/listar/', ['action' => 'index']);});
Router::scope('/articulos',['controller' => 'Articulos'],function (RouteBuilder $routes) {    $routes->connect('/', ['action' => 'menu']);});
//accesorios
Router::scope('/accesorios',['controller' => 'Accesorios'],function (RouteBuilder $routes) {    $routes->connect('/ver/*', ['action' => 'view']);});
Router::scope('/accesorios',['controller' => 'Accesorios'],function (RouteBuilder $routes) {    $routes->connect('/editar/*', ['action' => 'edit']);});
Router::scope('/accesorios',['controller' => 'Accesorios'],function (RouteBuilder $routes) {    $routes->connect('/nuevo/*', ['action' => 'add']);});
Router::scope('/accesorios',['controller' => 'Accesorios'],function (RouteBuilder $routes) {    $routes->connect('/listar/', ['action' => 'index']);});
Router::scope('/accesorios',['controller' => 'Accesorios'],function (RouteBuilder $routes) {    $routes->connect('/', ['action' => 'menu']);});
//general
Router::scope('/',['controller' => 'Usuarios'],function (RouteBuilder $routes) {    $routes->connect('/salir', ['action' => 'logout']);});
Router::scope('/',['controller' => 'Usuarios'],function (RouteBuilder $routes) {    $routes->connect('/ingresar/*', ['action' => 'login']);});
Router::scope('/',['controller' => 'Usuarios'],function (RouteBuilder $routes) {    $routes->connect('/registrate/*', ['action' => 'signup']);});
Router::scope('/', function (RouteBuilder $routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks(DashedRoute::class);
});

/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
