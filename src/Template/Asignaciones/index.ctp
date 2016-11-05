<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Asignacion'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Procesos'), ['controller' => 'Procesos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Proceso'), ['controller' => 'Procesos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Articulo'), ['controller' => 'Articulos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="asignaciones index large-9 medium-8 columns content">
    <h3><?= __('Asignaciones') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('titulo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('proceso_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('articulo_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hasta') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($asignaciones as $asignacion): ?>
            <tr>
                <td><?= $this->Number->format($asignacion->id) ?></td>
                <td><?= h($asignacion->titulo) ?></td>
                <td><?= $asignacion->has('proceso') ? $this->Html->link($asignacion->proceso->id, ['controller' => 'Procesos', 'action' => 'view', $asignacion->proceso->id]) : '' ?></td>
                <td><?= $asignacion->has('articulo') ? $this->Html->link($asignacion->articulo->id, ['controller' => 'Articulos', 'action' => 'view', $asignacion->articulo->id]) : '' ?></td>
                <td><?= h($asignacion->hasta) ?></td>
                <td><?= h($asignacion->created) ?></td>
                <td><?= h($asignacion->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $asignacion->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $asignacion->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $asignacion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $asignacion->id)]) ?>
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
