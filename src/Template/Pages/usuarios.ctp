<?php use Cake\Routing\Router;?>
<?=$this->assign('title',"Usuarios")?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?>
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="tlf"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
    </ul>
</nav>
<div class="modelos form large-9 medium-8 columns content">
    <fieldset style="padding: 0">
        <h1 class="usu"><?= __('Usuarios') ?></h1>
        <?= $this->Form->create() ?>
        <div class="slice">
            <ul>
            <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
                <li id="first">
                    <a href="<?=Router::url(array('controller' => 'Trabajadores', 'action' => 'index'))?>"style="color:white; background-color: #720e9e">Mis trabajadores</a>
                </li>
                <li>
                    <a href="<?=Router::url(array('controller' => 'Trabajadores', 'action' => 'view',$this->request->session()->read('Auth.User.trabajador_id')))?>"style="color:white; background-color: #500a6f">Mi trabajador</a>
                </li>
            <?php else: ?>
                <li id="first">
                    <a href="<?=Router::url(array('controller' => 'Trabajadores', 'action' => 'index'))?>" style="color:white; background-color: #720e9e">Listar</a>
                </li>
                <li>
                    <a href="<?=Router::url(array('controller' => 'Trabajadores', 'action' => 'add'))?>" style="color:white; background-color: #500a6f">Agregar</a>
                </li>
            <?php endif; ?>
            </ul>
        </div>
        <div class="lapel">
            <h1 style="color:purple">Trabajadores</h1>
        </div>
            <div class="slice">
                <ul>
                <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
                    <li id="first">
                        <a href="<?=Router::url(array('controller' => 'Contratos', 'action' => 'index'))?>"style="color:white; background-color: mediumvioletred">Mi contrato</a>
                    </li>
                <?php else: ?>
                    <li id="first">
                    <a href="<?=Router::url(array('controller' => 'Contratos', 'action' => 'index'))?>" style="color:white; background-color: mediumvioletred">Listar</a>
                </li>
                <li>
                    <a href="<?=Router::url(array('controller' => 'Contratos', 'action' => 'add'))?>" style="color:white; background-color: crimson">Agregar</a>
                </li>
                <?php endif; ?>
                </ul>
            </div>
            <div class="lapel">
                <h1 style="color: magenta">Contratos</h1>
            </div>

        <div class="slice">
            <ul>
            <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
                <li id="first">
                    <a href="<?=Router::url(array('controller' => 'Usuarios', 'action' => 'view', $this->request->session()->read('Auth.User.id')))?>" style="color:#1c2529; background-color: salmon"><?= $this->request->session()->read('Auth.User.nombre_de_usuario')?></a>
                </li>
            <?php else: ?>
                <li id="first">
                    <a href="<?=Router::url(array('controller' => 'Usuarios', 'action' => 'index'))?>"style="color:#1c2529; background-color: hotpink">Listar</a>
                </li>
                <li>
                    <a href="<?=Router::url(array('controller' => 'Usuarios', 'action' => 'add'))?>"style="color:#1c2529; background-color: salmon">Agregar</a>
                </li>
            <?php endif; ?>
            </ul>
        </div>
        <div class="lapel">
            <h1 style="color: #b25151">Usuarios</h1>
        </div>
        <br><br>
        <?= $this->Form->end() ?>
    </fieldset>
</div>