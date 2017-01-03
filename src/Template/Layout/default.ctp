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
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
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
    <?= $this->Html->script('scripts')?>
</head>
<body>
    <nav class="top-bar" data-topbar role="navigation">
        <ul class="title-area large-2 medium-4 columns">
            <h1 style="height: 5rem;width:8rem">
                <a href="/WIT" style="height: 100%; position: relative; width: 100%">
                    <img  src="/WIT/webroot/img/Wit.png" alt="WiT" >
                    <!--[if IE]><p></p><![endif]-->
                    <!--[if !IE]>--><p>Sistema web de inventario y telefonía</p><!--<![endif]-->
                </a>
            </h1>
        </ul>
        <nav class="top-bar-section">
            <ul class="right">
                <?php if(!$this->request->session()->read('Auth.User')):?>
                    <?php if($this->request->action=='signup'||$this->request->action=='reset'): ?>
                        <li>
                            <a href="/WIT/ingresar" class="button">Ingresar</a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="/WIT/registrate" class="button">Registrate</a>
                        </li>
                    <?php endif; ?>
                <?php else: ?>
                    <li>
                        <div class="dropdownx" style="float:right;">
                            <button class="dropbtnx"><?= $this->request->session()->read('Auth.User.nombre_de_usuario')?></button>
                            <div class="dropdownx-content">
                                <div class="dropdownx-content-background">
                                <?= $this->Html->link('Mi perfil',['controller' => 'Usuarios', 'action' => 'view', $this->request->session()->read('Auth.User.id')]) ?>
                                <a id="salir" href="/WIT/usuarios/salir">Salir</a>
                                <div>
                            </div>
                        </div>
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
