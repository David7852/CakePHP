<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Factura'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Linea'), ['controller' => 'Lineas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Consumos'), ['controller' => 'Consumos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Consumo'), ['controller' => 'Consumos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="facturas index large-9 medium-8 columns content">
    <h3><?= __('Facturas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('titulo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('linea_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('paguese_antes_de') ?></th>
                <th scope="col"><?= $this->Paginator->sort('balance') ?></th>
                <th scope="col"><?= $this->Paginator->sort('desde') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hasta') ?></th>
                <th scope="col"><?= $this->Paginator->sort('numero_de_cuenta') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($facturas as $factura): ?>
            <tr>
                <td><?= $this->Number->format($factura->id) ?></td>
                <td><?= h($factura->titulo) ?></td>
                <td><?= $factura->has('linea') ? $this->Html->link($factura->linea->id, ['controller' => 'Lineas', 'action' => 'view', $factura->linea->id]) : '' ?></td>
                <td><?= h($factura->paguese_antes_de) ?></td>
                <td><?= $this->Number->format($factura->balance) ?></td>
                <td><?= h($factura->desde) ?></td>
                <td><?= h($factura->hasta) ?></td>
                <td><?= h($factura->numero_de_cuenta) ?></td>
                <td><?= h($factura->created) ?></td>
                <td><?= h($factura->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $factura->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $factura->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $factura->id], ['confirm' => __('Are you sure you want to delete # {0}?', $factura->id)]) ?>
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
