<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Consumo'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Facturas'), ['controller' => 'Facturas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Factura'), ['controller' => 'Facturas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Rentas'), ['controller' => 'Rentas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Renta'), ['controller' => 'Rentas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="consumos index large-9 medium-8 columns content">
    <h3><?= __('Consumos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('titulo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('factura_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('renta_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('consumido') ?></th>
                <th scope="col"><?= $this->Paginator->sort('excedente') ?></th>
                <th scope="col"><?= $this->Paginator->sort('monto_bs') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($consumos as $consumo): ?>
            <tr>
                <td><?= $this->Number->format($consumo->id) ?></td>
                <td><?= h($consumo->titulo) ?></td>
                <td><?= $consumo->has('factura') ? $this->Html->link($consumo->factura->id, ['controller' => 'Facturas', 'action' => 'view', $consumo->factura->id]) : '' ?></td>
                <td><?= $consumo->has('renta') ? $this->Html->link($consumo->renta->id, ['controller' => 'Rentas', 'action' => 'view', $consumo->renta->id]) : '' ?></td>
                <td><?= h($consumo->consumido) ?></td>
                <td><?= h($consumo->excedente) ?></td>
                <td><?= $this->Number->format($consumo->monto_bs) ?></td>
                <td><?= h($consumo->created) ?></td>
                <td><?= h($consumo->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $consumo->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $consumo->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $consumo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $consumo->id)]) ?>
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
