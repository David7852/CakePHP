<?php use Cake\Routing\Router;?>
<?=$this->assign('title',"Telefonia")?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?>
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="tlf"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
    </ul>
</nav>
<div class="modelos form large-9 medium-8 columns content">
    <fieldset>
        <legend><?= __('Control De Inventario') ?></legend>
        <?= $this->Form->create() ?>
        <div class="slice">
            <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
                <li>
                    <a href="<?=Router::url(array('controller' => 'Trabajadores', 'action' => 'index'))?>">Otros</a>
                </li>
                <li>
                    <a href="<?=Router::url(array('controller' => 'Trabajadores', 'action' => 'view',$this->request->session()->read('Auth.User.trabajador_id')))?>">Mi trabajador</a>
                </li>
            <?php else: ?>
                <li>
                    <a href="<?=Router::url(array('controller' => 'Trabajadores', 'action' => 'index'))?>">Listar</a>
                </li>
                <li>
                    <a href="<?=Router::url(array('controller' => 'Trabajadores', 'action' => 'add'))?>">Agregar</a>
                </li>
            <?php endif; ?>
        </div>
        <div class="lapel">
            <h1>Trabajadores</h1>
        </div>
        <div class="slice">
            <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
                <li>
                    <a href="<?=Router::url(array('controller' => 'Contratos', 'action' => 'index'))?>">Mi contrato</a>
                </li>
            <?php else: ?>
                <li>
                    <a href="<?=Router::url(array('controller' => 'Contratos', 'action' => 'index'))?>">Listar</a>
                </li>
                <li>
                    <a href="<?=Router::url(array('controller' => 'Contratos', 'action' => 'add'))?>">Agregar</a>
                </li>
            <?php endif; ?>
        </div>
        <div class="lapel">
            <h1>Contratos</h1>
        </div>

        <div class="slice">
            <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
                <li>
                    <a href="<?=Router::url(array('controller' => 'Usuarios', 'action' => 'view', $this->request->session()->read('Auth.User.id')))?>"><?= $this->request->session()->read('Auth.User.nombre_de_usuario')?></a>
                </li>
            <?php else: ?>
                <li>
                    <a href="<?=Router::url(array('controller' => 'Usuarios', 'action' => 'index'))?>">Listar</a>
                </li>
                <li>
                    <a href="<?=Router::url(array('controller' => 'Usuarios', 'action' => 'add'))?>">Agregar</a>
                </li>
            <?php endif; ?>
        </div>
        <div class="lapel">
            <h1>Usuarios</h1>
        </div>
        <?= $this->Form->end() ?>
    </fieldset>
</div>