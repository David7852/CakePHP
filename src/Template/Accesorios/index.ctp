<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Accesorio'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Articulo'), ['controller' => 'Articulos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="accesorios index large-9 medium-8 columns content">
    <h3><?= __('Accesorios') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('descripcion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('articulo_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($accesorios as $accesorio): ?>
            <tr>
                <td><?= $this->Number->format($accesorio->id) ?></td>
                <td><?= h($accesorio->descripcion) ?></td>
                <td><?= $accesorio->has('articulo') ? $this->Html->link($accesorio->articulo->id, ['controller' => 'Articulos', 'action' => 'view', $accesorio->articulo->id]) : '' ?></td>
                <td><?= h($accesorio->created) ?></td>
                <td><?= h($accesorio->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $accesorio->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $accesorio->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $accesorio->id], ['confirm' => __('Are you sure you want to delete # {0}?', $accesorio->id)]) ?>
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
