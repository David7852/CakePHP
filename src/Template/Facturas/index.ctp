<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Nueva Factura'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nueva Linea'), ['controller' => 'Lineas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Consumos'), ['controller' => 'Consumos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nuevo Consumo'), ['controller' => 'Consumos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="facturas index large-9 medium-8 columns content">
    <h3><?= __('Facturas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('linea_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('paguese_antes_de') ?></th>
                <th scope="col"><?= $this->Paginator->sort('balance') ?></th>
                <th scope="col"><?= $this->Paginator->sort('desde') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hasta') ?></th>
                <th scope="col"><?= $this->Paginator->sort('numero_de_cuenta') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($facturas as $factura): ?>
            <tr>
                <td><?= $factura->has('linea') ? $this->Html->link($factura->linea->numero, ['controller' => 'Lineas', 'action' => 'view', $factura->linea->id]) : '' ?></td>
                <td><?= h($factura->paguese_antes_de) ?></td>
                <td><?= $this->Number->format($factura->balance).' Bs' ?></td>
                <td><?= h($factura->desde) ?></td>
                <td><?= h($factura->hasta) ?></td>
                <td><?= h($factura->numero_de_cuenta) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $factura->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $factura->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $factura->id], ['confirm' => __('¿Confirma querer eliminar la factura del {0}?', $factura->title)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('<')) ?>
            <?= str_replace("of","de",$this->Paginator->numbers()) ." ". str_replace("of","de",$this->Paginator->counter()) ?>
            <?= $this->Paginator->next(__('>') . ' >') ?>
        </ul>

    </div>
</div>
