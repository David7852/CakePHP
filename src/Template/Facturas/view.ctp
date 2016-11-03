<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Factura'), ['action' => 'edit', $factura->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Factura'), ['action' => 'delete', $factura->id], ['confirm' => __('Are you sure you want to delete # {0}?', $factura->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Facturas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Factura'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Linea'), ['controller' => 'Lineas', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="facturas view large-9 medium-8 columns content">
    <h3><?= h($factura->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Titulo') ?></th>
            <td><?= h($factura->Titulo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Linea') ?></th>
            <td><?= $factura->has('linea') ? $this->Html->link($factura->linea->id, ['controller' => 'Lineas', 'action' => 'view', $factura->linea->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Numero De Cuenta') ?></th>
            <td><?= h($factura->Numero_De_Cuenta) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($factura->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Balance') ?></th>
            <td><?= $this->Number->format($factura->Balance) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Paguese Antes De') ?></th>
            <td><?= h($factura->Paguese_Antes_De) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Desde') ?></th>
            <td><?= h($factura->Desde) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hasta') ?></th>
            <td><?= h($factura->Hasta) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($factura->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($factura->modified) ?></td>
        </tr>
    </table>
</div>
