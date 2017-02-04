<?php use Cake\Routing\Router;?>
<?=$this->assign('title',"Solicitudes")?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="tlf"><?= $this->Html->link(__('Telefonía'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <li class="usu"><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
    </ul>
</nav>
<div class="modelos form large-9 medium-8 columns content">
    <fieldset style="padding: 0">
        <h1 class="sol"><?= __('Solicitudes') ?></h1>
        <?= $this->Form->create() ?>
        <div class="slice">
            <ul>
                <li class="first">
                    <a href="<?=Router::url(array('controller' => 'Procesos', 'action' => 'solicitar'))?>" style="color:#1c2529; background-color: #00c0ef">Hacer solicitud</a>
                </li>
                <li>
                    <a href="<?=Router::url(array('controller' => 'Procesos', 'action' => 'index',$this->request->session()->read('Auth.User.trabajador_id')))?>"style="color:#1c2529; background-color: aquamarine">Mis solicitudes</a>
                </li>
            <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?>
                <li class="first">
                    <a href="<?=Router::url(array('controller' => 'Procesos', 'action' => 'index'))?>" style="color:#1c2529; background-color: #5bc0de">Listar</a>
                </li>
                <li>
                    <a href="<?=Router::url(array('controller' => 'Procesos', 'action' => 'add'))?>"style="color:#1c2529; background-color: #5897fb">Agregar</a>
                </li>
            <?php endif; ?>
            </ul>
        </div>
        <div class="lapel">
            <h1 style="color: #77c0cc ; text-shadow: 0px 0px 1px rgba(119,192,204,0.55),0px 0px 2px rgba(119,192,204,0.2)">Procesos</h1>
        </div>
        <div class="slice">
            <ul>
                <li class="first">
                    <a href="<?=Router::url(array('controller' => 'Asignaciones', 'action' => 'index',$this->request->session()->read('Auth.User.trabajador_id')))?>" style="color:white; background-color: #0a6b5a">Mis asignaciones</a>
                </li>
            <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?>
                <li class="first">
                    <a href="<?=Router::url(array('controller' => 'Asignaciones', 'action' => 'index'))?>" style="color:white; background-color: #1b6d6d">Listar</a>
                </li>
                <li>
                    <a href="<?=Router::url(array('controller' => 'Asignaciones', 'action' => 'add'))?>" style="color:white; background-color: #3d969b">Agregar</a>
                </li>
            <?php endif; ?>
            </ul>
        </div>
        <div class="lapel">
            <h1 style="color: teal; text-shadow: 0px 0px 1px rgba(0,128,128,0.55),0px 0px 2px rgba(0,128,128,0.2)">Asignaciones</h1>
        </div>

        <div class="slice">
            <ul>
            <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?>
                <li class="first">
                    <a href="<?=Router::url(array('controller' => 'Devoluciones', 'action' => 'index'))?>" style="color:white; background-color: #003f54">Listar</a>
                </li>
                <li>
                    <a href="<?=Router::url(array('controller' => 'Devoluciones', 'action' => 'add'))?>" style="color:white; background-color: #305777">Agregar</a>
                </li>
            <?php endif; ?>
                <li>
                    <a href="<?=Router::url(array('controller' => 'Devoluciones', 'action' => 'index',$this->request->session()->read('Auth.User.trabajador_id')))?>"style="color:white; background-color: #1c2d3f">Mis devoluciones</a>
                </li>
            </ul>
        </div>
        <div class="lapel">
            <h1 style="color: midnightblue; text-shadow: 0px 0px 1px rgba(25,25,112,0.55),0px 0px 2px rgba(25,25,112,0.2)">Devoluciones</h1>
        </div>
        <br><br>
        <?= $this->Form->end() ?>
    </fieldset>
</div>