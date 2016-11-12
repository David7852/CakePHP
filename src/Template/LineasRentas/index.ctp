<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('New Lineas Renta'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Linea'), ['controller' => 'Lineas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Rentas'), ['controller' => 'Rentas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Renta'), ['controller' => 'Rentas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="lineasRentas index large-9 medium-8 columns content">
    <h3><?= __('Lineas Rentas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('linea_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('renta_id') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lineasRentas as $lineasRenta): ?>
            <tr>
                <td><?= $lineasRenta->has('linea') ? $this->Html->link($lineasRenta->linea->numero, ['controller' => 'Lineas', 'action' => 'view', $lineasRenta->linea->id]) : '' ?></td>
                <td><?= $lineasRenta->has('renta') ? $this->Html->link($lineasRenta->renta->nombre, ['controller' => 'Rentas', 'action' => 'view', $lineasRenta->renta->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $lineasRenta->linea_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $lineasRenta->linea_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $lineasRenta->linea_id], ['confirm' => __('Are you sure you want to delete # {0}?', $lineasRenta->linea_id)]) ?>
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
