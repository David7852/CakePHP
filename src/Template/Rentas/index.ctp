<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Renta'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Linea'), ['controller' => 'Lineas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rentas index large-9 medium-8 columns content">
    <h3><?= __('Rentas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Nombre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Monto_Basico') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rentas as $renta): ?>
            <tr>
                <td><?= $this->Number->format($renta->id) ?></td>
                <td><?= h($renta->Nombre) ?></td>
                <td><?= $this->Number->format($renta->Monto_Basico) ?></td>
                <td><?= h($renta->created) ?></td>
                <td><?= h($renta->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $renta->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $renta->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $renta->id], ['confirm' => __('Are you sure you want to delete # {0}?', $renta->id)]) ?>
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
