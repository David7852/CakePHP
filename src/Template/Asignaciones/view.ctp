<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Asignacion'), ['action' => 'edit', $asignacion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Asignacion'), ['action' => 'delete', $asignacion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $asignacion->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Asignaciones'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asignacion'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Procesos'), ['controller' => 'Procesos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Proceso'), ['controller' => 'Procesos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Articulo'), ['controller' => 'Articulos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="asignaciones view large-9 medium-8 columns content">
    <h3><?= h($asignacion->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Titulo') ?></th>
            <td><?= h($asignacion->titulo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Proceso') ?></th>
            <td><?= $asignacion->has('proceso') ? $this->Html->link($asignacion->proceso->id, ['controller' => 'Procesos', 'action' => 'view', $asignacion->proceso->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Articulo') ?></th>
            <td><?= $asignacion->has('articulo') ? $this->Html->link($asignacion->articulo->id, ['controller' => 'Articulos', 'action' => 'view', $asignacion->articulo->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($asignacion->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hasta') ?></th>
            <td><?= h($asignacion->hasta) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($asignacion->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($asignacion->modified) ?></td>
        </tr>
    </table>
</div>
