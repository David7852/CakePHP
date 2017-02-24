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
<a id="bcktop"></a>
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
    <?php if($this->request->action!='signup'&&$this->request->action!='reset'&&$this->request->action!='login'): ?>
        <a href="#bcktop" style="z-index: 11">
            <button id="difbtm" class="_W6g _S6g _ufp nb-fades">
                <g-fab class="_jAg">
                    <span class="_HAg">
                        <svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M4,12l1.41,1.41L11,7.83V20h2V7.83l5.58,5.59L20,12l-8,-8 -8,8z"></path>
                        </svg>
                    </span>
                </g-fab>
            </button>
        </a>
    <?php endif; ?>
    <?= $this->request->action=='login'? '<footer style="margin-top: 0!important;">':'<footer>' ?>
            <div style="vertical-align: middle;background-color: #fbfbfb; background-image: url(/WIT/webroot/img/bodyTexture.png);">
                <table class="fertinitro" style="margin-bottom: .25rem">
                    <tbody>
                    <tr >
                        <td valign="top" style="text-align: left; padding: 0;overflow: visible;max-width: 50%!important;height: 100%;">
                            <a href="http://www.pequiven.com" class="title-area large-2 medium-3 columns" style="width: 100%;height: 100%;color:red; margin: auto;padding: 1.65rem 0.75rem 0.75rem 0.75rem;">
                                <img style="size: auto;max-width: 100%;" src="/WIT/webroot/img/logopqv.png" alt="Pequiven">
                            </a>
                        </td>
                        <td style="float:right; padding: 0; max-width: 50%!important;height: 100%;display: inline-table;">
                            <a href="//10.10.0.74/fertinitro" class="title-area large-2 medium-3 columns right" style="width: 100%;height: 100%;color:#006600;margin: auto;padding: 1.65rem 0.75rem 0.75rem 0.75rem;">
                                <img style="size: auto;max-width: 100%;" src="/WIT/webroot/img/fertinitro.png" alt="FertiNitro">
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table width="100%" style="background-color: #fbfbfb; background-image: url(/WIT/webroot/img/bodyTexture.png); margin-bottom: 0;">
                    <tbody>
                    <tr style="border-bottom: none;height: auto;max-height: 50px;padding: 0;">
                        <td style="text-align: left;padding: 0;width: 50%;padding-bottom: 0!important;padding-top: 0!important;max-width: 50%;">
                            <img style="width: 100%; max-width: 330px; height: auto;max-height: 49px;size: auto;" src="/WIT/webroot/img/cintillo izquierda.png" width="330" height="49">
                        </td>
                        <td style="float:right; width: 50%;max-width: 186px;max-height: 50px;height: auto;padding: 0;overflow: hidden;margin-left: 3rem;display: inline-table;">
                            <img style="width: 100%; max-width: 186px; height: auto; max-height: 49px; SIZE: auto; " src="/WIT/webroot/img/cintillo derecha.png" width="186" height="49">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </footer>
</body>
</html>
