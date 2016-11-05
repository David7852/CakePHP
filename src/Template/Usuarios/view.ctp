<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Editar este Usuario'), ['action' => 'edit', $usuario->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Eliminar este Usuario'), ['action' => 'delete', $usuario->id], ['confirm' => __('¿Esta seguro de querer eliminar al usuario {0}?', $usuario->nombre_de_usuario)]) ?> </li>
        <li><?= $this->Html->link(__('Listar Usuarios'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Usuario'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Trabajadores'), ['controller' => 'Trabajadores', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Trabajador'), ['controller' => 'Trabajadores', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="usuarios view large-9 medium-8 columns content">
    <h3><?= h($usuario->funcion).": ".h($usuario->nombre_de_usuario) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre Completo') ?></th>
            <td><?= $usuario->has('trabajador') ? $this->Html->link($usuario->trabajador->name, ['controller' => 'Trabajadores', 'action' => 'view', $usuario->trabajador->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($usuario->email) ?></td>
        </tr>
    </table>
</div>
