<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Proceso'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="procesos index large-9 medium-8 columns content">
    <h3><?= __('Procesos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Titulo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('trabajor_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Motivo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Fecha_De_Solicitud') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Fecha_De_Aprobacion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($procesos as $proceso): ?>
            <tr>
                <td><?= $this->Number->format($proceso->id) ?></td>
                <td><?= h($proceso->Titulo) ?></td>
                <td><?= $this->Number->format($proceso->trabajor_id) ?></td>
                <td><?= h($proceso->Motivo) ?></td>
                <td><?= h($proceso->Fecha_De_Solicitud) ?></td>
                <td><?= h($proceso->Fecha_De_Aprobacion) ?></td>
                <td><?= h($proceso->created) ?></td>
                <td><?= h($proceso->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $proceso->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $proceso->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $proceso->id], ['confirm' => __('Are you sure you want to delete # {0}?', $proceso->id)]) ?>
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
