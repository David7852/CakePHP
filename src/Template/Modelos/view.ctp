<?=$this->assign('title',"Modelos y Marcas")?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="inv" id="seleccion"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <!-- $ -->

        <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
            <li><?= $this->Html->link(__('Solicitar'), ['controller'=>'Procesos','action' => 'solicitar']) ?></li>
            <li><?= $this->Html->link(__('Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?></li>
        <?php else: ?>
        <li><?= $this->Html->link(__('Editar'), ['action' => 'edit', $modelo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $modelo->id], ['confirm' => __('¿Confirma querer eliminar el tipo de {0}?', $modelo->titulo)]) ?> </li>
        <?php endif; ?>
        <!-- $ -->
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="tlf"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <li class="usu"><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
    </ul>
</nav>
<div class="modelos view large-9 medium-8 columns content">
    <div class="imagedisplay">
    <table >
        <tr>
            <td>
                <h4><?= h($modelo->tipo_de_articulo) ?></h4>
            </td>
        </tr>
        <tr>
            <td>
                <h4><?= "Marca: ". h($modelo->marca) ?></h4><br>
            </td>
        </tr>
        <tr>
            <td>
                <h4><?= "Modelo: ". h($modelo->modelo) ?></h4><br>
            </td>
        </tr>
    </table>
        <figure>
            <img src="/WIT/webroot/img/Modelos/<?= h($modelo->imagen) ?>">
        </figure>
    </div>
    <table class="vertical-table">
        <?php if($modelo->abstracto!=''): ?>
            <tr>
                <th scope="row"><?= __('Campo extra') ?></th>
                <td> <?= h($modelo->abstracto) ?></td>
            </tr>
        <?php endif; ?>
    </table>
    <?php if (!empty($modelo->articulos)&&$this->request->session()->read('Auth.User.funcion')!='Visitante'): ?>
    <div class="related">
        <h4><?= __('Articulos de este modelo') ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Serial') ?></th>
                <th scope="col"><?= __('Datos') ?></th>
                <th scope="col"><?= __('Ubicacion') ?></th>
                <th scope="col"><?= __('Estado') ?></th>
                <th scope="col"><?= __('Fecha De Compra') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($modelo->articulos as $articulos): ?>
            <tr>
                <td><?= h($articulos->serial) ?></td>
                <td><?= h($articulos->datos) ?></td>
                <td><?= h($articulos->ubicacion) ?></td>
                <td><?= h($articulos->estado) ?></td>
                <td><?= h($articulos->fecha_de_compra) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Articulos', 'action' => 'view', $articulos->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Articulos', 'action' => 'edit', $articulos->id]) ?>
                <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?><!-->
                    <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Articulos', 'action' => 'delete', $articulos->id], ['confirm' => __('¿Confirma querer eliminar al articulo #{0}?', $articulos->serial)]) ?>
                <?php endif; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
</div>
