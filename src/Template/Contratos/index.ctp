<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Contrato'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Trabajores'), ['controller' => 'Trabajores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Trabajore'), ['controller' => 'Trabajores', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="contratos index large-9 medium-8 columns content">
    <h3><?= __('Contratos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Titulo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('trabajor_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Fecha_De_Inicio') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Fecha_De_Culminacion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contratos as $contrato): ?>
            <tr>
                <td><?= $this->Number->format($contrato->id) ?></td>
                <td><?= h($contrato->Titulo) ?></td>
                <td><?= $contrato->has('trabajore') ? $this->Html->link($contrato->trabajore->id, ['controller' => 'Trabajores', 'action' => 'view', $contrato->trabajore->id]) : '' ?></td>
                <td><?= h($contrato->Fecha_De_Inicio) ?></td>
                <td><?= h($contrato->Fecha_De_Culminacion) ?></td>
                <td><?= h($contrato->created) ?></td>
                <td><?= h($contrato->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $contrato->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contrato->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contrato->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contrato->id)]) ?>
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
