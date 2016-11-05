<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Linea'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Articulo'), ['controller' => 'Articulos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Facturas'), ['controller' => 'Facturas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Factura'), ['controller' => 'Facturas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Rentas'), ['controller' => 'Rentas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Renta'), ['controller' => 'Rentas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="lineas index large-9 medium-8 columns content">
    <h3><?= __('Lineas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('numero') ?></th>
                <th scope="col"><?= $this->Paginator->sort('puk') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pin') ?></th>
                <th scope="col"><?= $this->Paginator->sort('codigo_sim') ?></th>
                <th scope="col"><?= $this->Paginator->sort('articulo_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('observaciones') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
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
                <td><?= h($linea->created) ?></td>
                <td><?= h($linea->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $linea->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $linea->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $linea->id], ['confirm' => __('Are you sure you want to delete # {0}?', $linea->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
