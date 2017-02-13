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
use App\Controller\Component\savory;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\Routing\Router;

$this->layout = false;

if (!Configure::read('debug')):
    throw new NotFoundException('Please replace src/Template/Pages/home.ctp with your own version.');
endif;
$savoire=new savory();
$cakeDescription = 'WIT';
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
            <img  src="/WIT/webroot/img/gem wit.png" alt="WIT" >
            <h1></h1>
        </div>
    </header>
    <div id="content" class="home-bg">
        <div class="row">
            <div class="columns large-12 ctp-warning checks">
                ¡Bienvenidos A WIT: El Sistema Web Para El Control Del Inventario Y La Telefonía Móvil de FertiNitro C.E.C.!
            </div>
            <div style="margin-bottom: -7rem;z-index: 0;">
                <div class="slice" style="z-index: 0">
                    <ul style="z-index: 0">
                        <li class="first" style="z-index: 0">
                            <a href="<?=Router::url(array('controller' => '/', 'action' => 'solicitudes'))?>" style="color:white; background-color: rgb(55, 123, 165)">Solicitudes</a>
                        </li>
                        <li>
                            <a href="<?=Router::url(array('controller' => '/', 'action' => 'inventario'))?>" style="color:white; background-color: rgb(203, 103, 51);">Inventario</a>
                        </li>
                        <li class="first" style="z-index: 0">
                            <a href="<?=Router::url(array('controller' => '/', 'action' => 'telefonia'))?>" style="color:white; background-color: #00b14c">Telefonía</a>
                        </li>
                        <li>
                            <a href="<?=Router::url(array('controller' => '/', 'action' => 'usuarios'))?>" style="color:white; background-color: rgb(184, 65, 110)">Usuarios</a>
                        </li>
                    </ul>
                </div>
                <div class="lapel" style="z-index: 0; margin-left: 0.15rem; margin-right: 0.15rem">
                    <h1></h1>
                </div>
            </div>
            <div class="columns large-12 checks">
                <h4 style="text-transform: capitalize">unete y participa</h4>
                <div><?= $savoire->gettrbdata() ?></div>
                <hr>
                <h4 style="text-transform: capitalize">Estamos a su disposición</h4>
                <div><?= $savoire->getinvdata() ?></div>
                <hr>
                <h4 style="text-transform: capitalize">Manténte en contacto</h4>
                <div><?= $savoire->gettlfdata() ?></div>
                <hr>
                <h4 style="text-transform: capitalize">Apreciamos sus aportes e ideas</h4>
                <div><?= $savoire->getcontactinfo() ?></div>
            </div>
        </div>

        <div class="row">
            <div class="columns large-6">
                <h3>Misión</h3>
                <p><dfn style="color: rgb(56,118,29); font-style: normal ; font-weight: bold">Ferti</dfn><dfn style="color: rgb(137,180,43); font-style: normal ; font-weight: bold">Nitro</dfn> tiene la misión de producir y comercializar urea y amoniaco de alta calidad operando de forma segura y eficiente en armonía con el ambiente, fortaleciendo nuestro talento humano e impulsando el desarrollo sustentable del país.</p>
            </div>
            <div class="columns large-6">
                <h3>Vision</h3>
                <p>La visión de <dfn style="color: rgb(56,118,29); font-style: normal ; font-weight: bold">Ferti</dfn><dfn style="color: rgb(137,180,43); font-style: normal ; font-weight: bold">Nitro</dfn> es ser reconocida a nivel nacional e internacional como la empresa más confiable y rentable en producción y comercialización de urea y amoníaco de alta calidad.</p>
            </div>
        </div><div>
        <hr style="border-color: rgba(195, 35, 45, 0.92); border-width: 2px"></div>
        <br>
        <br>
    </div>
</body>
<footer >
    <div style="vertical-align: middle">
        <a href="http://www.pequiven.com" class="title-area large-2 medium-3 columns" style="color:red; margin: auto; padding: 1.65rem 0.75rem 0.75rem 2.75rem;"><img src="/WIT/webroot/img/logopqv.png" alt="Pequiven"></a>
        <a href="//10.10.0.74/fertinitro" class="title-area large-2 medium-3 columns right" style="color:#006600;margin: auto;padding: 1.65rem 0.75rem 0.75rem 0.75rem;"><img src="/WIT/webroot/img/fertinitro.png" alt="FertiNitro"></a>
        <table width="100%" style="margin-bottom: 0.5rem">
            <tbody>
            <tr style="border-bottom: none">
                <td valign="top" style="text-align: left; padding: 0 0 0 2rem">
                    <img src="/WIT/webroot/img/cintillo izquierda.png" width="316" height="49">
                </td>
                <td valign="top" align="right" style="text-align: right; padding: 0 2rem 0 0"><img src="/WIT/webroot/img/cintillo derecha.png" width="186" height="49"></td>
            </tr>
            </tbody>
        </table>
    </div>
</footer>
</html>
