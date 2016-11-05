<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Consumo'), ['action' => 'edit', $consumo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Consumo'), ['action' => 'delete', $consumo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $consumo->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Consumos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Consumo'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Facturas'), ['controller' => 'Facturas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Factura'), ['controller' => 'Facturas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Rentas'), ['controller' => 'Rentas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Renta'), ['controller' => 'Rentas', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="consumos view large-9 medium-8 columns content">
    <h3><?= h($consumo->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Titulo') ?></th>
            <td><?= h($consumo->titulo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Factura') ?></th>
            <td><?= $consumo->has('factura') ? $this->Html->link($consumo->factura->id, ['controller' => 'Facturas', 'action' => 'view', $consumo->factura->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Renta') ?></th>
            <td><?= $consumo->has('renta') ? $this->Html->link($consumo->renta->id, ['controller' => 'Rentas', 'action' => 'view', $consumo->renta->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Consumido') ?></th>
            <td><?= h($consumo->consumido) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Excedente') ?></th>
            <td><?= h($consumo->excedente) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($consumo->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Monto Bs') ?></th>
            <td><?= $this->Number->format($consumo->monto_bs) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($consumo->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($consumo->modified) ?></td>
        </tr>
    </table>
</div>
