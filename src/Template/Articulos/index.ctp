<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Nuevo Articulo'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Modelos'), ['controller' => 'Modelos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nuevo Modelo'), ['controller' => 'Modelos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Accesorios'), ['controller' => 'Accesorios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nuevo Accesorio'), ['controller' => 'Accesorios', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Asignaciones'), ['controller' => 'Asignaciones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Formar Asignacion'), ['controller' => 'Asignaciones', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Devoluciones'), ['controller' => 'Devoluciones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Formar Devolucion'), ['controller' => 'Devoluciones', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nueva Linea'), ['controller' => 'Lineas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="articulos index large-9 medium-8 columns content">
    <h3><?= __('Articulos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('serial') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modelo_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ubicacion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('estado')?></th>
                <th scope="col"><?= $this->Paginator->sort('fecha_de_compra') ?></th>
                <th scope="col"><?= $this->Paginator->sort('datos') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articulos as $articulo): ?>
            <tr>
                <td><?= h($articulo->serial) ?></td>
                <td><?= $articulo->has('modelo') ? $this->Html->link($articulo->modelo->titulo, ['controller' => 'Modelos', 'action' => 'view', $articulo->modelo->id]) : '' ?></td>
                <td><?= h($articulo->ubicacion) ?></td>
                <td><?= h($articulo->estado) ?></td>
                <td><?= h($articulo->fecha_de_compra) ?></td>
                <td><?= h($articulo->datos) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $articulo->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $articulo->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $articulo->id], ['confirm' => __('¿Confirma querer eliminar el articulo {0}?', $articulo->titulo)]) ?>
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
