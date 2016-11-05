<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Modelo'), ['action' => 'edit', $modelo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Modelo'), ['action' => 'delete', $modelo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $modelo->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Modelos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Modelo'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Articulo'), ['controller' => 'Articulos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="modelos view large-9 medium-8 columns content">
    <h3><?= h($modelo->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Marca') ?></th>
            <td><?= h($modelo->marca) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modelo') ?></th>
            <td><?= h($modelo->modelo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo De Articulo') ?></th>
            <td><?= h($modelo->tipo_de_articulo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Serial Comun') ?></th>
            <td><?= h($modelo->serial_comun) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Abstracto') ?></th>
            <td><?= h($modelo->abstracto) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($modelo->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($modelo->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($modelo->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Imagen') ?></h4>
        <?= $this->Text->autoParagraph(h($modelo->imagen)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Articulos') ?></h4>
        <?php if (!empty($modelo->articulos)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Serial') ?></th>
                <th scope="col"><?= __('Modelo Id') ?></th>
                <th scope="col"><?= __('Datos') ?></th>
                <th scope="col"><?= __('Ubicacion') ?></th>
                <th scope="col"><?= __('Estado') ?></th>
                <th scope="col"><?= __('Fecha De Compra') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($modelo->articulos as $articulos): ?>
            <tr>
                <td><?= h($articulos->id) ?></td>
                <td><?= h($articulos->serial) ?></td>
                <td><?= h($articulos->modelo_id) ?></td>
                <td><?= h($articulos->datos) ?></td>
                <td><?= h($articulos->ubicacion) ?></td>
                <td><?= h($articulos->estado) ?></td>
                <td><?= h($articulos->fecha_de_compra) ?></td>
                <td><?= h($articulos->created) ?></td>
                <td><?= h($articulos->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Articulos', 'action' => 'view', $articulos->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Articulos', 'action' => 'edit', $articulos->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Articulos', 'action' => 'delete', $articulos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $articulos->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
