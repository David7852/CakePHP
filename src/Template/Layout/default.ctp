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
$cakeDescription = 'WIT ';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-bar" data-topbar role="navigation">
        <ul class="title-area large-2 medium-4 columns">
            <h1>
                <a href="/WIT">
                    <img src="/WIT\webroot\img\Wit.png" alt="WiT" >
                </a>
            </h1>
        </ul>
        <nav class="top-bar-section">
            <ul class="right">
                <?php if(!$this->request->session()->read('Auth.User')):?>
                    <?php if($this->request->action=='signup'): ?>
                        <li><?= $this->Html->link('Ingresar',['controller' => 'Usuarios', 'action' => 'login']) ?></li>
                    <?php else: ?>
                    <li>
                        <?= $this->Html->link('Registrarse',['controller' => 'Usuarios', 'action' => 'signup']) ?>
                    </li>
                    <?php endif; ?>
                <?php else: ?>
                    <li>
                        <?= $this->Html->link($this->request->session()->read('Auth.User.nombre_de_usuario'),['controller' => 'Usuarios', 'action' => 'view', $this->request->session()->read('Auth.User.id')]) ?>
                    </li>
                    <li id="salir">
                        <?= $this->Html->link('SALIR',['controller' => 'Usuarios', 'action' => 'logout']) ?>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
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
</body>
</html>
