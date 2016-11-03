<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Modelo'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="modelos index large-9 medium-8 columns content">
    <h3><?= __('Modelos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Marca') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Modelo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Tipo_De_Articulo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Serial_Comun') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Abstracto') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($modelos as $modelo): ?>
            <tr>
                <td><?= $this->Number->format($modelo->id) ?></td>
                <td><?= h($modelo->Marca) ?></td>
                <td><?= h($modelo->Modelo) ?></td>
                <td><?= h($modelo->Tipo_De_Articulo) ?></td>
                <td><?= h($modelo->Serial_Comun) ?></td>
                <td><?= h($modelo->Abstracto) ?></td>
                <td><?= h($modelo->created) ?></td>
                <td><?= h($modelo->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $modelo->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $modelo->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $modelo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $modelo->id)]) ?>
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
