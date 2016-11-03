<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Devolucion'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Procesos'), ['controller' => 'Procesos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Proceso'), ['controller' => 'Procesos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Articulo'), ['controller' => 'Articulos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="devoluciones index large-9 medium-8 columns content">
    <h3><?= __('Devoluciones') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Titulo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Proceso_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Articulo_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($devoluciones as $devolucion): ?>
            <tr>
                <td><?= $this->Number->format($devolucion->id) ?></td>
                <td><?= h($devolucion->Titulo) ?></td>
                <td><?= $devolucion->has('proceso') ? $this->Html->link($devolucion->proceso->id, ['controller' => 'Procesos', 'action' => 'view', $devolucion->proceso->id]) : '' ?></td>
                <td><?= $devolucion->has('articulo') ? $this->Html->link($devolucion->articulo->id, ['controller' => 'Articulos', 'action' => 'view', $devolucion->articulo->id]) : '' ?></td>
                <td><?= h($devolucion->created) ?></td>
                <td><?= h($devolucion->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $devolucion->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $devolucion->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $devolucion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $devolucion->id)]) ?>
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
