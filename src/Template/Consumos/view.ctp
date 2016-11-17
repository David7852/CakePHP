<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Editar este Consumo'), ['action' => 'edit', $consumo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Eliminar este Consumo'), ['action' => 'delete', $consumo->id], ['confirm' => __('¿Confirma querer eliminar el consumo {0}?', $consumo->titulo)]) ?> </li>
        <li><?= $this->Html->link(__('Listar Consumos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Consumo'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Facturas'), ['controller' => 'Facturas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nueva Factura'), ['controller' => 'Facturas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Servicios'), ['controller' => 'Servicio', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Servicio'), ['controller' => 'Servicio', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="consumos view large-9 medium-8 columns content">
    <h3><?= h($consumo->titulo) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Factura') ?></th>
            <td><?= $consumo->has('factura') ? $this->Html->link($consumo->factura->titulo, ['controller' => 'Facturas', 'action' => 'view', $consumo->factura->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Servicio') ?></th>
            <td><?= $consumo->has('servicio') ? $this->Html->link($consumo->servicio->titulo, ['controller' => 'Servicio', 'action' => 'view', $consumo->servicio->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cupo') ?></th>
            <td><?= h($consumo->cupo) ?></td>
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
            <th scope="row"><?= __('Monto') ?></th>
            <td><?= $this->Number->format($consumo->monto_bs).' Bs' ?></td>
        </tr>
    </table>
</div>
