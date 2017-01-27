<?php use Cake\Routing\Router;?>
<?=$this->assign('title',"Telefonia")?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?>
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="usu"><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
    </ul>
</nav>
<div class="modelos form large-9 medium-8 columns content">
    <fieldset style="padding: 0">
        <h1 class="tlf"><?= __('Telefonia') ?></h1>
        <?= $this->Form->create() ?>
        <div class="slice">
            <ul>
            <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?>
                <li id="first">
                    <a href="<?=Router::url(array('controller' => 'Lineas', 'action' => 'add'))?>"style="color:white; background-color: #3ea97f">Agregar</a>
                </li>
                <li >
                    <a href="<?=Router::url(array('controller' => 'Lineas', 'action' => 'index'))?>"style="color:white; background-color: #00b14c">Listar</a>
                </li>
                <li id="first">
                    <a href="<?=Router::url(array('controller' => 'Procesos', 'action' => 'asociarequipo'))?>"style="color:#1c2529; background-color: rgb(135,185,115)">Asignar Linea</a>
                </li>
                <li>
                    <a href="<?=Router::url(array('controller' => 'Procesos', 'action' => 'devolverequipo'))?>"style="color:#1c2529; background-color: #b8de87">Devolver Linea</a>
                </li>
            <?php else: ?>
                <li id="first">
                    <a href="<?=Router::url(array('controller' => 'Lineas', 'action' => 'index',$this->request->session()->read('Auth.User.trabajador_id')))?>" style="color:#1c2529; background-color: #c9e2b3">Mis lineas</a>
                </li>
                <li>
                    <a href="<?=Router::url(array('controller' => 'Articulos', 'action' => 'inventario','Celular'))?>"style="color:#1c2529; background-color: burlywood">Mis celulares</a>
                </li>
            <?php endif; ?>
            </ul>
        </div>
        <div class="lapel">
            <h1 style="color: forestgreen; text-shadow: 0px 0px 1px rgba(34,134,34,0.55),0px 0px 2px rgba(34,134,34,0.2)">Lineas y Equipos</h1>
        </div>
            <div class="slice">
                <ul>
                    <li id="first">
                        <a href="<?=Router::url(array('controller' => 'Rentas', 'action' => 'index'))?>" style="color:#1c2529; background-color: lightgreen ">Ver Rentas</a>
                    </li>
                    <li>
                        <a href="<?=Router::url(array('controller' => 'Servicios', 'action' => 'index'))?>" style="color:white; background-color: seagreen">Ver Servicios</a>
                    </li>
                </ul>
            </div>
            <div class="lapel">
                <h1 style="color: #4ba567; text-shadow: 0px 0px 1px rgba(75,165,103,0.55),0px 0px 2px rgba(75,165,103,0.2)">Planes y Servicios</h1>
            </div>
        <div class="slice">
            <ul>

                    <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?>
                    <li id="first">
                        <a href="<?=Router::url(array('controller' => 'Consumos', 'action' => 'index'))?>" style="color:white; background-color: #4c5124">Listar</a>
                    </li>
                    <li>
                        <a href="<?=Router::url(array('controller' => 'Consumos', 'action' => 'add'))?>" style="color:white; background-color: #788b46">Agregar</a>
                    </li>
                <?php endif; ?>
                <li id="first">
                    <a href="<?=Router::url(array('controller' => 'Consumos', 'action' => 'index', $this->request->session()->read('Auth.User.id')))?>" style="color:white; background-color: rgb(115,151,51)">Mis consumos</a>
                </li>
            </ul>
        </div>
        <div class="lapel">
            <h1 style="color: darkolivegreen; text-shadow: 0px 0px 1px rgba(85,107,47,0.55),0px 0px 2px rgba(85,107,47,0.2)">Consumos</h1>
        </div>
        <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?>
        <div class="slice">
            <ul>

                <li id="first">
                    <a href="<?=Router::url(array('controller' => 'Contratos', 'action' => 'index'))?>"style="color:white; background-color: #7b6e51">Listar</a>
                </li>
                <li>
                    <a href="<?=Router::url(array('controller' => 'Contratos', 'action' => 'add'))?>"style="color:white; background-color: #855a28">Agregar</a>
                </li>

            </ul>
        </div>
        <div class="lapel">
            <h1 style="color: saddlebrown; text-shadow: 0px 0px 1px rgba(139,69,19,0.55),0px 0px 2px rgba(139,69,19,0.2)">Facturas</h1>
        </div>
        <?php endif; ?>
        <br><br>
        <?= $this->Form->end() ?>
    </fieldset>
</div>