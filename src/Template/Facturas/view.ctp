<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Editar esta Factura'), ['action' => 'edit', $factura->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Eliminar esta Factura'), ['action' => 'delete', $factura->id], ['confirm' => __('¿Confirma querer eliminar la factura {0}?', $factura->titulo)]) ?> </li>
        <li><?= $this->Html->link(__('Listar Facturas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nueva Factura'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nueva Linea'), ['controller' => 'Lineas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Consumos'), ['controller' => 'Consumos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Consumo'), ['controller' => 'Consumos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="facturas view large-9 medium-8 columns content">
    <h3><?= 'Factura del '.h($factura->titulo) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Linea') ?></th>
            <td><?= $factura->has('linea') ? $this->Html->link($factura->linea->numero, ['controller' => 'Lineas', 'action' => 'view', $factura->linea->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Numero De Cuenta') ?></th>
            <td><?= h($factura->numero_de_cuenta) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Balance') ?></th>
            <td><?= $this->Number->format($factura->balance).' Bs' ?></td>
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
            <th scope="row"><?= __('Paguese Antes De') ?></th>
            <td><?= h($factura->paguese_antes_de) ?></td>
        </tr>
    </table>
    <?php if (!empty($factura->consumos)): ?>
    <div class="related">
        <h4><?= __('Consumos') ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Titulo') ?></th>
                <th scope="col"><?= __('Renta Id') ?></th>
                <th scope="col"><?= __('Consumido') ?></th>
                <th scope="col"><?= __('Excedente') ?></th>
                <th scope="col"><?= __('Monto') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($factura->consumos as $consumos): ?>
            <tr>
                <td><?= h($consumos->titulo) ?></td>
                <td><?= h($consumos->renta_id) ?></td>
                <td><?= h($consumos->consumido) ?></td>
                <td><?= h($consumos->excedente) ?></td>
                <td><?= h($consumos->monto_bs).' Bs' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Consumos', 'action' => 'view', $consumos->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Consumos', 'action' => 'edit', $consumos->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Consumos', 'action' => 'delete', $consumos->id], ['confirm' => __('¿Confirma querer eliminar el consumo de {0}?', $consumos->titulo)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
</div>
