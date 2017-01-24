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
    <fieldset style="padding: 0">
        <h1 class="inv"><?= __('Inventario') ?></h1>
        <?= $this->Form->create() ?>
        <div class="slice">
            <ul>
            <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
            <li id="first">
                <a href="<?=Router::url(array('controller' => 'Accesorios', 'action' => 'index'))?>" style="color:white; background-color: #e65200">Ver mis accesorios</a>
            </li>
            <li>
                <a href="<?=Router::url(array('controller' => 'Procesos', 'action' => 'solicitar'))?>" style="color:white; background-color: #ce563f">Solicitar un accesorio</a>
            </li>
            <?php else: ?>
                <li id="first">
                <a href="<?=Router::url(array('controller' => 'Accesorios', 'action' => 'index'))?>" style="color:white; background-color: #e65200">Listar</a>
            </li>
            <li>
                <a href="<?=Router::url(array('controller' => 'Accesorios', 'action' => 'add'))?>" style="color:white; background-color: #ce563f">Agregar</a>
            </li>
            <?php endif; ?>
            </ul>
        </div>
        <div class="lapel">
            <h1 style="color: #cf591f">Accesorios</h1>
        </div>
        <div class="slice">
            <ul>
                <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
                    <li id="first">
                        <a href="<?=Router::url(array('controller' => 'Modelos', 'action' => 'index'))?>" style="color:#1c2529; background-color: #d6d58e">Ver los Modelos</a>
                    </li>
                <?php else: ?>
            <li id="first">
                <a href="<?=Router::url(array('controller' => 'Modelos', 'action' => 'index'))?>" style="color:#1c2529; background-color: #d6d58e">Listar</a>
            </li>
            <li>
                <a href="<?=Router::url(array('controller' => 'Modelos', 'action' => 'add'))?>" style="color:#1c2529; background-color: #f7bc60">Agregar</a>
            </li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="lapel">
            <h1 style="color: #cdb949">Modelos</h1>
        </div>

        <div class="slice">
            <ul>
            <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
                <li id="first">
                    <a href="<?=Router::url(array('controller' => 'Articulos', 'action' => 'index'))?>" style="color:white; background-color: #843534" >Ver mis artículos</a>
                </li>
                <li>
                    <a href="<?=Router::url(array('controller' => 'Procesos', 'action' => 'solicitar'))?>" style="color:white; background-color: #9b2825">Solicitar un articulo</a>
                </li>
            <?php else: ?>
                <li id="first">
                <div style=" background-color: #ae2825">
                <h5>Buscar artículos<br> de tipo</h5>
                <div >
                    <?= $this->Form->input('tipo',['label'=>'']) ?>
                    <button type='submit'>
                        <svg  height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 15l-6 6-1.42-1.42L15.17 16H4V4h2v10h9.17l-3.59-3.58L13 9l6 6z"/>
                        </svg>
                    </button>
                </div>
                </div>
            </li>
            <li>
                <a href="<?=Router::url(array('controller' => 'Articulos', 'action' => 'index'))?>" style="color:white; background-color: #843534" >Listar todos</a>
            </li>
            <li>
                <a href="<?=Router::url(array('controller' => 'Articulos', 'action' => 'add'))?>" style="color:white; background-color: #cd5151">Agregar</a>
            </li>
            <?php endif; ?>
            </ul>
        </div>
        <div class="lapel">
            <h1 style="color: #c92514">Artículos</h1>
        </div>
        <br><br>
        <?= $this->Form->end() ?>
    </fieldset>
</div>