<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Formar Devolucion'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Procesos'), ['controller' => 'Procesos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nuevo Proceso'), ['controller' => 'Procesos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nuevo Articulo'), ['controller' => 'Articulos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="devoluciones index large-9 medium-8 columns content">
    <h3><?= __('Devoluciones') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('proceso_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('articulo_id') ?></th>
                <th scope="col" class="actions"><?= __('Aciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($devoluciones as $devolucion): ?>
            <tr>
                <td><?= $devolucion->has('proceso') ? $this->Html->link($devolucion->proceso->titulo, ['controller' => 'Procesos', 'action' => 'view', $devolucion->proceso->id]) : '' ?></td>
                <td><?= $devolucion->has('articulo') ? $this->Html->link($devolucion->articulo->titulo, ['controller' => 'Articulos', 'action' => 'view', $devolucion->articulo->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $devolucion->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $devolucion->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $devolucion->id], ['confirm' => __('¿Confirma querer eliminar la devolucion {0}?', $devolucion->titulo)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('<')) ?>
            <?= str_replace("of","de",$this->Paginator->numbers()) ." ". str_replace("of","de",$this->Paginator->counter()) ?>
            <?= $this->Paginator->next(__('>') . ' >') ?>
        </ul>

    </div>
</div>
