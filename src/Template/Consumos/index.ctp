<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Nuevo Consumo'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Facturas'), ['controller' => 'Facturas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nueva Factura'), ['controller' => 'Facturas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Rentas'), ['controller' => 'Rentas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nueva Renta'), ['controller' => 'Rentas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="consumos index large-9 medium-8 columns content">
    <h3><?= __('Consumos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('factura_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('renta_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cupo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('consumido') ?></th>
                <th scope="col"><?= $this->Paginator->sort('excedente') ?></th>
                <th scope="col"><?= $this->Paginator->sort('monto') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($consumos as $consumo): ?>
            <tr>
                <td><?= $consumo->has('factura') ? $this->Html->link($consumo->factura->titulo, ['controller' => 'Facturas', 'action' => 'view', $consumo->factura->id]) : '' ?></td>
                <td><?= $consumo->has('renta') ? $this->Html->link($consumo->renta->nombre, ['controller' => 'Rentas', 'action' => 'view', $consumo->renta->id]) : '' ?></td>
                <td><?= h($consumo->cupo) ?></td>
                <td><?= h($consumo->consumido) ?></td>
                <td><?= h($consumo->excedente) ?></td>
                <td><?= $this->Number->format($consumo->monto_bs).' Bs' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $consumo->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $consumo->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $consumo->id], ['confirm' => __('¿Confirma querer eliminar el consumo {0}?', $consumo->titulo)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('<')) ?>
            <?= str_replace("of","de",$this->Paginator->numbers()) ?>
            <?= $this->Paginator->next(__('>') . ' >') ?>
        </ul>
        <p><?= str_replace("of","de",$this->Paginator->counter()) ?></p>
    </div>
</div>
