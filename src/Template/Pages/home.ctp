<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use Cake\Routing\Router;
$this->layout = false;

if (!Configure::read('debug')):
    throw new NotFoundException('Please replace src/Template/Pages/home.ctp with your own version.');
endif;

$cakeDescription = 'CakePHP: the rapid development PHP framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
</head>
<body class="home">
    <header>
        <div class="header-image">
            <img  src="/WIT/webroot/img/gem wit.png" alt="WiT" >
            <h1>Sistema Web De<br>Inventario Y Telefonía</h1>
        </div>
    </header>
    <div id="content">
        <div class="row">
            <div class="columns large-12 ctp-warning checks">
                Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...
            </div>
            <div style="margin-bottom: -7rem;z-index: 0;">
                <div class="slice" style="z-index: 0">
                    <ul style="z-index: 0">
                        <li id="first" style="z-index: 0">
                            <a href="<?=Router::url(array('controller' => '/', 'action' => 'solicitudes'))?>" style="color:white; background-color: rgb(55, 123, 165)">Solicitudes</a>
                        </li>
                        <li>
                            <a href="<?=Router::url(array('controller' => '/', 'action' => 'inventario'))?>" style="color:white; background-color: rgb(203, 103, 51);">Inventario</a>
                        </li>
                        <li id="first" style="z-index: 0">
                            <a href="<?=Router::url(array('controller' => '/', 'action' => 'telefonia'))?>" style="color:white; background-color: #00b14c">Telefonía</a>
                        </li>
                        <li>
                            <a href="<?=Router::url(array('controller' => '/', 'action' => 'usuarios'))?>" style="color:white; background-color: rgb(184, 65, 110)">Usuarios</a>
                        </li>
                    </ul>
                </div>
                <div class="lapel" style="z-index: 0">
                    <h1></h1>
                </div>
            </div>
            <div class="columns large-12 checks">
                <h4>Environment</h4>
                <p>Some data...</p>
                <hr>
                <h4>Filesystem</h4>
                <p>Some data...</p>
                <hr>
                <h4>Database</h4>
                <p>Some data...</p>
                <hr>
                <h4>DebugKit</h4>
                <p>Some data...</p>
            </div>
        </div>

        <div class="row">
            <div class="columns large-6">
                <h3>Editing this Page</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <div class="columns large-6">
                <h3>Getting Started</h3>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>

            </div>
        </div>

        <hr style="border-color: rgba(195, 35, 45, 0.72); border-width: 2px">
        <br>
        <br>


    </div>
</body>
<footer >
    <div style="vertical-align: middle">
        <h4 class="title-area large-2 medium-3 columns" style="color:red;font-family:arial;margin-top: 7px;padding: 0.75em;">
            Pequiven
        </h4>
        <h4 class="title-area large-2 medium-3 columns right" style="color:#006600;font-family: 'Segoe UI Black';margin-top: 7px;padding: 0.5em;">
            FertiNitro
        </h4>
    </div>
</footer>
</html>
