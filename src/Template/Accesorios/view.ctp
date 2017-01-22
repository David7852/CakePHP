<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>

        <li class="inv" id="seleccion"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <!-- $ -->
        <li><?= $this->Html->link(__('Editar'), ['action' => 'edit', $accesorio->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $accesorio->id], ['confirm' => __('¿Confirma querer eliminar el accesorio: {0}?', $accesorio->titulo)]) ?> </li>
        <li><?= $this->Html->link(__('Accesorios'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Accesorio'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?> </li>
        <!-- $ -->
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="tlf"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <li class="usu"><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
    </ul>
</nav>
<div class="accesorios view large-9 medium-8 columns content">
    <h3><?= h($accesorio->titulo) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Descripcion') ?></th>
            <td><?= h($accesorio->descripcion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Articulo') ?></th>
            <td><?= $accesorio->has('articulo') ? $this->Html->link($accesorio->articulo->titulo, ['controller' => 'Articulos', 'action' => 'view', $accesorio->articulo->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estado') ?></th>
            <td><?= h($accesorio->estado) ?></td>
        </tr>
    </table>
</div>
