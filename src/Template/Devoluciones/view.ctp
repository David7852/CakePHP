<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Editar esta Devolucion'), ['action' => 'edit', $devolucion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Eliminar esta Devolucion'), ['action' => 'delete', $devolucion->id], ['confirm' => __('¿Confirma querer eliminar la devolucion {0}?', $devolucion->titulo)]) ?> </li>
        <li><?= $this->Html->link(__('Listar Devoluciones'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Formar Devolucion'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Procesos'), ['controller' => 'Procesos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Proceso'), ['controller' => 'Procesos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Articulo'), ['controller' => 'Articulos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="devoluciones view large-9 medium-8 columns content">
    <h3><?= h($devolucion->titulo) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Proceso') ?></th>
            <td><?= $devolucion->has('proceso') ? $this->Html->link($devolucion->proceso->titulo, ['controller' => 'Procesos', 'action' => 'view', $devolucion->proceso->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Articulo') ?></th>
            <td><?= $devolucion->has('articulo') ? $this->Html->link($devolucion->articulo->titulo, ['controller' => 'Articulos', 'action' => 'view', $devolucion->articulo->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estado') ?></th>
            <td style="color: #be140b"><?= h($devolucion->estado) ?></td>
        </tr>
    </table>
</div>
