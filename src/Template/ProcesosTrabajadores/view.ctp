<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Procesos Trabajadore'), ['action' => 'edit', $procesosTrabajadore->trabajador_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Procesos Trabajadore'), ['action' => 'delete', $procesosTrabajadore->trabajador_id], ['confirm' => __('Are you sure you want to delete # {0}?', $procesosTrabajadore->trabajador_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Procesos Trabajadores'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Procesos Trabajadore'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Trabajadores'), ['controller' => 'Trabajadores', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Trabajador'), ['controller' => 'Trabajadores', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Procesos'), ['controller' => 'Procesos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Proceso'), ['controller' => 'Procesos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="procesosTrabajadores view large-9 medium-8 columns content">
    <h3><?= h($procesosTrabajadore->trabajador_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Trabajador') ?></th>
            <td><?= $procesosTrabajadore->has('trabajador') ? $this->Html->link($procesosTrabajadore->trabajador->id, ['controller' => 'Trabajadores', 'action' => 'view', $procesosTrabajadore->trabajador->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Proceso') ?></th>
            <td><?= $procesosTrabajadore->has('proceso') ? $this->Html->link($procesosTrabajadore->proceso->id, ['controller' => 'Procesos', 'action' => 'view', $procesosTrabajadore->proceso->id]) : '' ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Rol') ?></h4>
        <?= $this->Text->autoParagraph(h($procesosTrabajadore->rol)); ?>
    </div>
</div>
