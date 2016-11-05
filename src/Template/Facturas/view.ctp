<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Factura'), ['action' => 'edit', $factura->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Factura'), ['action' => 'delete', $factura->id], ['confirm' => __('Are you sure you want to delete # {0}?', $factura->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Facturas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Factura'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Linea'), ['controller' => 'Lineas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Consumos'), ['controller' => 'Consumos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Consumo'), ['controller' => 'Consumos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="facturas view large-9 medium-8 columns content">
    <h3><?= h($factura->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Titulo') ?></th>
            <td><?= h($factura->titulo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Linea') ?></th>
            <td><?= $factura->has('linea') ? $this->Html->link($factura->linea->id, ['controller' => 'Lineas', 'action' => 'view', $factura->linea->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Numero De Cuenta') ?></th>
            <td><?= h($factura->numero_de_cuenta) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($factura->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Balance') ?></th>
            <td><?= $this->Number->format($factura->balance) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Paguese Antes De') ?></th>
            <td><?= h($factura->paguese_antes_de) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Desde') ?></th>
            <td><?= h($factura->desde) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hasta') ?></th>
            <td><?= h($factura->hasta) ?></td>
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
    <div class="related">
        <h4><?= __('Related Consumos') ?></h4>
        <?php if (!empty($factura->consumos)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Titulo') ?></th>
                <th scope="col"><?= __('Factura Id') ?></th>
                <th scope="col"><?= __('Renta Id') ?></th>
                <th scope="col"><?= __('Consumido') ?></th>
                <th scope="col"><?= __('Excedente') ?></th>
                <th scope="col"><?= __('Monto Bs') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($factura->consumos as $consumos): ?>
            <tr>
                <td><?= h($consumos->id) ?></td>
                <td><?= h($consumos->titulo) ?></td>
                <td><?= h($consumos->factura_id) ?></td>
                <td><?= h($consumos->renta_id) ?></td>
                <td><?= h($consumos->consumido) ?></td>
                <td><?= h($consumos->excedente) ?></td>
                <td><?= h($consumos->monto_bs) ?></td>
                <td><?= h($consumos->created) ?></td>
                <td><?= h($consumos->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Consumos', 'action' => 'view', $consumos->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Consumos', 'action' => 'edit', $consumos->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Consumos', 'action' => 'delete', $consumos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $consumos->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
