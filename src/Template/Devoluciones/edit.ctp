<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $devolucion->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $devolucion->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Devoluciones'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Procesos'), ['controller' => 'Procesos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Proceso'), ['controller' => 'Procesos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Articulo'), ['controller' => 'Articulos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="devoluciones form large-9 medium-8 columns content">
    <?= $this->Form->create($devolucion) ?>
    <fieldset>
        <legend><?= __('Edit Devolucion') ?></legend>
        <?php
            echo $this->Form->input('titulo');
            echo $this->Form->input('proceso_id', ['options' => $procesos]);
            echo $this->Form->input('articulo_id', ['options' => $articulos]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
