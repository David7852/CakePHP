<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Editar este Servicio'), ['action' => 'edit', $servicio->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete este Servicio'), ['action' => 'delete', $servicio->id], ['confirm' => __('Are you sure you want to delete # {0}?', $servicio->id)]) ?> </li>
        <li><?= $this->Html->link(__('Listar Servicios'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Servicio'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Rentas'), ['controller' => 'Rentas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nueva Renta'), ['controller' => 'Rentas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Consumos'), ['controller' => 'Consumos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Consumo'), ['controller' => 'Consumos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="servicios view large-9 medium-8 columns content">
    <h3><?= h($servicio->titulo) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($servicio->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cupo') ?></th>
            <td><?= h($servicio->cupo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Renta') ?></th>
            <td><?= $servicio->has('renta') ? $this->Html->link($servicio->renta->nombre, ['controller' => 'Rentas', 'action' => 'view', $servicio->renta->id]) : '' ?></td>
        </tr>
    </table>
    <?php if (!empty($servicio->consumos)): ?>
    <div class="related">
        <h4><?= __('Consumos: ') ?></h4>

        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Factura Id') ?></th>
                <th scope="col"><?= __('Cupo') ?></th>
                <th scope="col"><?= __('Consumido') ?></th>
                <th scope="col"><?= __('Excedente') ?></th>
                <th scope="col"><?= __('Monto Bs') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($servicio->consumos as $consumos): ?>
            <tr>
                <td><?= h($consumos->factura_id) ?></td>
                <td><?= h($consumos->cupo) ?></td>
                <td><?= h($consumos->consumido) ?></td>
                <td><?= h($consumos->excedente) ?></td>
                <td><?= h($consumos->monto_bs) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Consumos', 'action' => 'view', $consumos->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Consumos', 'action' => 'edit', $consumos->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Consumos', 'action' => 'delete', $consumos->id], ['confirm' => __('¿Confirma querer eliminar el consumo {0}?', $consumo->titulo)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
</div>
