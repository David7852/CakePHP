<?=$this->assign('title',"Modelos y Marcas")?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Editar este Modelo'), ['action' => 'edit', $modelo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Eliminar este Modelo'), ['action' => 'delete', $modelo->id], ['confirm' => __('¿Confirma querer eliminar el tipo de {0}?', $modelo->name)]) ?> </li>
        <li><?= $this->Html->link(__('Listar Modelos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Agregar Modelo'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Agregar Articulo'), ['controller' => 'Articulos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="modelos view large-9 medium-8 columns content">
    <h3><?= h($modelo->name) ?></h3>
    <table class="vertical-table">
        <tr><!-- La marca podría traer sugerencias. segun los registros previos-->
            <th scope="row"><?= __('Marca') ?></th>
            <td><?= h($modelo->marca) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modelo') ?></th>
            <td><?= h($modelo->modelo) ?></td>
        </tr>
        <tr><!-- El tipo de articulo podria traer sugerencias. segun los registros previos-->
            <th scope="row"><?= __('Tipo De Articulo') ?></th>
            <td><?= h($modelo->tipo_de_articulo) ?></td>
        </tr>
    </table>
    <div class="row"><!-- debería ir en la cabecera, junto con el titulo del modelo -->
        <h4><?= __('Imagen') ?></h4>
        <?= $this->Text->autoParagraph(h($modelo->imagen)); ?>
    </div>
    <?php if (!empty($modelo->articulos)): ?>
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
                    <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Articulos', 'action' => 'delete', $articulos->id], ['confirm' => __('¿Confirma querer eliminar al articulo #{0}?', $articulos->serial)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
</div>
