<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Editar esta Asignacion'), ['action' => 'edit', $asignacion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Eliminar esta Asignacion'), ['action' => 'delete', $asignacion->id], ['confirm' => __('¿Confirma querer eliminar la asignacion de {0}?', $asignacion->titulo)]) ?> </li>
        <li><?= $this->Html->link(__('Listar Asignaciones'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Formar Asignacion'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Procesos'), ['controller' => 'Procesos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Proceso'), ['controller' => 'Procesos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Articulo'), ['controller' => 'Articulos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="asignaciones view large-9 medium-8 columns content">
    <h3><?= h($asignacion->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Proceso') ?></th>
            <td><?= $asignacion->has('proceso') ? $this->Html->link($asignacion->proceso->titulo, ['controller' => 'Procesos', 'action' => 'view', $asignacion->proceso->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Articulo') ?></th>
            <td><?= $asignacion->has('articulo') ? $this->Html->link($asignacion->articulo->titulo, ['controller' => 'Articulos', 'action' => 'view', $asignacion->articulo->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hasta') ?></th>
            <td><?= h($asignacion->hasta) ?></td>
        </tr>
    </table>
</div>
