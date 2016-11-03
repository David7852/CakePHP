<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Linea'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Articulo'), ['controller' => 'Articulos', 'action' => 'add']) ?></li>
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
                <th scope="col"><?= $this->Paginator->sort('Numero') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Puk') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Pin') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Codigo_Sim') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Articulo_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lineas as $linea): ?>
            <tr>
                <td><?= $this->Number->format($linea->id) ?></td>
                <td><?= h($linea->Numero) ?></td>
                <td><?= $this->Number->format($linea->Puk) ?></td>
                <td><?= $this->Number->format($linea->Pin) ?></td>
                <td><?= h($linea->Codigo_Sim) ?></td>
                <td><?= $linea->has('articulo') ? $this->Html->link($linea->articulo->id, ['controller' => 'Articulos', 'action' => 'view', $linea->articulo->id]) : '' ?></td>
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
