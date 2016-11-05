<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Devolucion'), ['action' => 'edit', $devolucion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Devolucion'), ['action' => 'delete', $devolucion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $devolucion->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Devoluciones'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Devolucion'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Procesos'), ['controller' => 'Procesos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Proceso'), ['controller' => 'Procesos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Articulo'), ['controller' => 'Articulos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="devoluciones view large-9 medium-8 columns content">
    <h3><?= h($devolucion->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Titulo') ?></th>
            <td><?= h($devolucion->titulo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Proceso') ?></th>
            <td><?= $devolucion->has('proceso') ? $this->Html->link($devolucion->proceso->id, ['controller' => 'Procesos', 'action' => 'view', $devolucion->proceso->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Articulo') ?></th>
            <td><?= $devolucion->has('articulo') ? $this->Html->link($devolucion->articulo->id, ['controller' => 'Articulos', 'action' => 'view', $devolucion->articulo->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($devolucion->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($devolucion->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($devolucion->modified) ?></td>
        </tr>
    </table>
</div>
