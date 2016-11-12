<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Editar este Accesorio'), ['action' => 'edit', $accesorio->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Eliminar este Accesorio'), ['action' => 'delete', $accesorio->id], ['confirm' => __('¿Confirma querer eliminar el accesorio: {0}?', $accesorio->titulo)]) ?> </li>
        <li><?= $this->Html->link(__('Listar Accesorios'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Accesorio'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Articulo'), ['controller' => 'Articulos', 'action' => 'add']) ?> </li>
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
            <td><?= h($articulo->estado) ?></td>
        </tr>
    </table>
</div>
