<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $procesosTrabajadore->trabajador_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $procesosTrabajadore->trabajador_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Procesos Trabajadores'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Trabajadores'), ['controller' => 'Trabajadores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Trabajador'), ['controller' => 'Trabajadores', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Procesos'), ['controller' => 'Procesos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Proceso'), ['controller' => 'Procesos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="procesosTrabajadores form large-9 medium-8 columns content">
    <?= $this->Form->create($procesosTrabajadore) ?>
    <fieldset>
        <legend><?= __('Edit Procesos Trabajadore') ?></legend>
        <?php
            echo $this->Form->input('rol');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
