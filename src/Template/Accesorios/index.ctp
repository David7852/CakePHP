<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Nuevo Accesorio'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nuevo Articulo'), ['controller' => 'Articulos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="accesorios index large-9 medium-8 columns content">
    <h3><?= __('Accesorios') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('descripcion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('estado') ?></th>
                <th scope="col"><?= $this->Paginator->sort('articulo_id') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($accesorios as $accesorio): ?>
            <tr>
                <td><?= h($accesorio->descripcion) ?></td>
                <td><?= h($accesorio->estado) ?></td>
                <td><?= $accesorio->has('articulo') ? $this->Html->link($accesorio->articulo->titulo, ['controller' => 'Articulos', 'action' => 'view', $accesorio->articulo->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $accesorio->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $accesorio->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $accesorio->id], ['confirm' => __('¿Confirma querer eliminar el accesorio: {0}?', $accesorio->titulo)]) ?>
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
