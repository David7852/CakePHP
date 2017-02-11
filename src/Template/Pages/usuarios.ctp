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
                <li class="first">
                    <a href="<?=Router::url(array('controller' => 'Trabajadores', 'action' => 'index'))?>"style="color:white; background-color: #720e9e">Mis trabajadores</a>
                </li>
                <li>
                    <a href="<?=Router::url(array('controller' => 'Trabajadores', 'action' => 'view',$this->request->session()->read('Auth.User.trabajador_id')))?>"style="color:white; background-color: #912dad">Mi trabajador</a>
                </li>
            <?php else: ?>
                <li class="first">
                    <a href="<?=Router::url(array('controller' => 'Trabajadores', 'action' => 'index'))?>" style="color:white; background-color: #720e9e">Listar</a>
                </li>

                <li>
                    <a href="<?=Router::url(array('controller' => 'Trabajadores', 'action' => 'add'))?>" style="color:white; background-color: #912dad">Agregar</a>
                </li>
            <?php endif; ?>
                <li class="superlabel first">
                    <div style=" background-color: #662c7f">
                        <h5>Buscar Trabajador<br>de nombre:</h5>
                        <div >
                            <?= $this->Form->input('nombre',['label'=>'','style'=>'color: #662c7f']) ?>
                            <button type='submit' style="color: #662c7f" name="nombrebtn">
                                <svg  height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 15l-6 6-1.42-1.42L15.17 16H4V4h2v10h9.17l-3.59-3.58L13 9l6 6z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="lapel">
            <h1 style="color:purple; text-shadow: 0px 0px 1px rgba(128,0,128,0.55),0px 0px 2px rgba(128,0,128,0.2)">Trabajadores</h1>
        </div>
            <div class="slice">
                <ul>
                <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'||$this->request->session()->read('Auth.User.funcion')=='Operador'): ?>
                    <li class="first">
                        <a href="<?=Router::url(array('controller' => 'Contratos', 'action' => 'index'))?>"style="color:white; background-color: mediumvioletred">Mi contrato</a>
                    </li>
                    <li class="superlabel">
                        <div style=" background-color: #941d7b">
                            <h5>Trabajadores en<br>Gerencia o cargo:</h5>
                            <div >
                                <?= $this->Form->input('gerencia',['label'=>'','style'=>'color: #941d7b']) ?>
                                <button type='submit' style="color: #941d7b" name="gerbtn">
                                    <svg  height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19 15l-6 6-1.42-1.42L15.17 16H4V4h2v10h9.17l-3.59-3.58L13 9l6 6z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </li>
                <?php else: ?>
                    <li class="first">
                    <a href="<?=Router::url(array('controller' => 'Contratos', 'action' => 'index'))?>" style="color:white; background-color: mediumvioletred">Listar</a>
                </li>
                    <li class="superlabel">
                        <div style=" background-color: #941d7b">
                            <h5>Trabajadores en<br>Gerencia o cargo:</h5>
                            <div >
                                <?= $this->Form->input('gerencia',['label'=>'','style'=>'color: #941d7b']) ?>
                                <button type='submit' style="color: #941d7b" name="gerbtn">
                                    <svg  height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19 15l-6 6-1.42-1.42L15.17 16H4V4h2v10h9.17l-3.59-3.58L13 9l6 6z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </li>
                <li class="first">
                    <a href="<?=Router::url(array('controller' => 'Contratos', 'action' => 'add'))?>" style="color:white; background-color: crimson">Agregar</a>
                </li>
                <?php endif; ?>
                </ul>
            </div>
            <div class="lapel">
                <h1 style="color: #dc1478; text-shadow: 0px 0px 1px rgba(220,20,120,0.55),0px 0px 2px rgba(220,20,120,0.2)">Contratos</h1>
            </div>

        <div class="slice">
            <ul>
            <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
                <li>
                    <a href="<?=Router::url(array('controller' => 'Usuarios', 'action' => 'view', $this->request->session()->read('Auth.User.id')))?>" style="color:#1c2529; background-color: salmon"><?= $this->request->session()->read('Auth.User.nombre_de_usuario')?></a>
                </li>
            <?php else: ?>
                <li class="first">
                    <a href="<?=Router::url(array('controller' => 'Usuarios', 'action' => 'index'))?>"style="color:#1c2529; background-color: hotpink">Listar</a>
                </li>
                <li>
                    <a href="<?=Router::url(array('controller' => 'Usuarios', 'action' => 'add'))?>"style="color:#1c2529; background-color: salmon">Agregar</a>
                </li>
            <?php endif; ?>
            </ul>
        </div>
        <div class="lapel">
            <h1 style="color: #b25151; text-shadow: 0px 0px 1px rgba(178,81,81,0.55),0px 0px 2px rgba(178,81,81,0.2)">Usuarios</h1>
        </div>
        <br><br>
        <?= $this->Form->end() ?>
    </fieldset>
</div>