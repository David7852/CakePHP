<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('New Procesos Trabajadore'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Trabajadores'), ['controller' => 'Trabajadores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Trabajador'), ['controller' => 'Trabajadores', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Procesos'), ['controller' => 'Procesos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Proceso'), ['controller' => 'Procesos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="procesosTrabajadores index large-9 medium-8 columns content">
    <h3><?= __('Procesos Trabajadores') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('trabajador_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('proceso_id') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($procesosTrabajadores as $procesosTrabajadore): ?>
            <tr>
                <td><?= $procesosTrabajadore->has('trabajador') ? $this->Html->link($procesosTrabajadore->trabajador->id, ['controller' => 'Trabajadores', 'action' => 'view', $procesosTrabajadore->trabajador->id]) : '' ?></td>
                <td><?= $procesosTrabajadore->has('proceso') ? $this->Html->link($procesosTrabajadore->proceso->id, ['controller' => 'Procesos', 'action' => 'view', $procesosTrabajadore->proceso->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $procesosTrabajadore->trabajador_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $procesosTrabajadore->trabajador_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $procesosTrabajadore->trabajador_id], ['confirm' => __('Are you sure you want to delete # {0}?', $procesosTrabajadore->trabajador_id)]) ?>
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
