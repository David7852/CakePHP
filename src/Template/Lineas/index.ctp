<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Agregar Linea'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Agregar Articulo'), ['controller' => 'Articulos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Facturas'), ['controller' => 'Facturas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nueva Factura'), ['controller' => 'Facturas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Rentas'), ['controller' => 'Rentas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nueva Renta'), ['controller' => 'Rentas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="lineas index large-9 medium-8 columns content">
    <h3><?= __('Lineas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('numero') ?></th>
                <th scope="col"><?= $this->Paginator->sort('puk') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pin') ?></th>
                <th scope="col"><?= $this->Paginator->sort('codigo_sim') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Equipo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('observaciones') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lineas as $linea): ?>
            <tr>
                <td><?= $this->Number->format($linea->id) ?></td>
                <td><?= h($linea->numero) ?></td>
                <td><?= $this->Number->format($linea->puk) ?></td>
                <td><?= $this->Number->format($linea->pin) ?></td>
                <td><?= h($linea->codigo_sim) ?></td>
                <td><?= $linea->has('articulo') ? $this->Html->link($linea->articulo->id, ['controller' => 'Articulos', 'action' => 'view', $linea->articulo->id]) : '' ?></td>
                <td><?= h($linea->observaciones) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $linea->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $linea->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $linea->id], ['confirm' => __('¿Confirma querer eliminar la linea {0}?', $linea->id)]) ?>
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
