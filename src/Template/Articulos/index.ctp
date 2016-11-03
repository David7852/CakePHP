<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Articulo'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Modelos'), ['controller' => 'Modelos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Modelo'), ['controller' => 'Modelos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="articulos index large-9 medium-8 columns content">
    <h3><?= __('Articulos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Serial') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Modelo_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Datos') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Ubicacion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Fecha_De_Compra') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articulos as $articulo): ?>
            <tr>
                <td><?= $this->Number->format($articulo->id) ?></td>
                <td><?= h($articulo->Serial) ?></td>
                <td><?= $articulo->has('modelo') ? $this->Html->link($articulo->modelo->id, ['controller' => 'Modelos', 'action' => 'view', $articulo->modelo->id]) : '' ?></td>
                <td><?= h($articulo->Datos) ?></td>
                <td><?= h($articulo->Ubicacion) ?></td>
                <td><?= h($articulo->Fecha_De_Compra) ?></td>
                <td><?= h($articulo->created) ?></td>
                <td><?= h($articulo->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $articulo->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $articulo->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $articulo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $articulo->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
