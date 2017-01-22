<?php use Cake\Routing\Router;?>
<?=$this->assign('title',"Inventario")?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="tlf"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <li class="usu"><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
    </ul>
</nav>
<div class="modelos form large-9 medium-8 columns content">
    <fieldset>
        <legend><?= __('Control De Inventario') ?></legend>
        <?= $this->Form->create() ?>
        <div class="slice">
            <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
            <li>
                <a href="<?=Router::url(array('controller' => 'Accesorios', 'action' => 'index'))?>">Ver mis accesorios</a>
            </li>
            <li>
                <a href="<?=Router::url(array('controller' => 'Procesos', 'action' => 'solicitar'))?>">Solicitar un accesorio</a>
            </li>
            <?php else: ?>
            <li>
                <a href="<?=Router::url(array('controller' => 'Accesorios', 'action' => 'index'))?>">Listar</a>
            </li>
            <li>
                <a href="<?=Router::url(array('controller' => 'Accesorios', 'action' => 'add'))?>">Agregar</a>
            </li>
            <?php endif; ?>
        </div>
        <div class="lapel">
            <h1>Accesorios</h1>
        </div>
        <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?>
        <div class="slice">
            <li>
                <a href="<?=Router::url(array('controller' => 'Modelos', 'action' => 'index'))?>">Listar</a>
            </li>
            <li>
                <a href="<?=Router::url(array('controller' => 'Modelos', 'action' => 'add'))?>">Agregar</a>
            </li>
        </div>
        <div class="lapel">
            <h1>Modelos</h1>
        </div>
        <?php endif; ?>
        <div class="slice">
            <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
                <li>
                    <a href="<?=Router::url(array('controller' => 'Accesorios', 'action' => 'index'))?>">Ver mis articulos</a>
                </li>
                <li>
                    <a href="<?=Router::url(array('controller' => 'Procesos', 'action' => 'solicitar'))?>">Solicitar un articulo</a>
                </li>
            <?php else: ?>
            <li>
                <a href="<?=Router::url(array('controller' => 'Articulos', 'action' => 'inventario'))?>">Buscar articulos de tipo</a>
                <?= $this->Form->input('tipo') ?>
                <button type='submit' class="buttonsidenote-center">
                    <svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 15l-6 6-1.42-1.42L15.17 16H4V4h2v10h9.17l-3.59-3.58L13 9l6 6z"/>
                    </svg>
                </button>
            </li>

            <li>
                <a href="<?=Router::url(array('controller' => 'Articulos', 'action' => 'index'))?>">Listar todos</a>
            </li>
            <li>
                <a href="<?=Router::url(array('controller' => 'Articulos', 'action' => 'add'))?>">Agregar</a>
            </li>
            <?php endif; ?>
        </div>
        <div class="lapel">
            <h1>Articulos</h1>
        </div>
        <?= $this->Form->end() ?>
    </fieldset>
</div>