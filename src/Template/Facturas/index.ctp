<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Factura'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Linea'), ['controller' => 'Lineas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="facturas index large-9 medium-8 columns content">
    <h3><?= __('Facturas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Titulo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Linea_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Paguese_Antes_De') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Balance') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Desde') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Hasta') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Numero_De_Cuenta') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($facturas as $factura): ?>
            <tr>
                <td><?= $this->Number->format($factura->id) ?></td>
                <td><?= h($factura->Titulo) ?></td>
                <td><?= $factura->has('linea') ? $this->Html->link($factura->linea->id, ['controller' => 'Lineas', 'action' => 'view', $factura->linea->id]) : '' ?></td>
                <td><?= h($factura->Paguese_Antes_De) ?></td>
                <td><?= $this->Number->format($factura->Balance) ?></td>
                <td><?= h($factura->Desde) ?></td>
                <td><?= h($factura->Hasta) ?></td>
                <td><?= h($factura->Numero_De_Cuenta) ?></td>
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
