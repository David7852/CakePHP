<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $asignacion->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $asignacion->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Asignaciones'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Procesos'), ['controller' => 'Procesos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Proceso'), ['controller' => 'Procesos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Articulo'), ['controller' => 'Articulos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="asignaciones form large-9 medium-8 columns content">
    <?= $this->Form->create($asignacion) ?>
    <fieldset>
        <legend><?= __('Edit Asignacion') ?></legend>
        <?php
            echo $this->Form->input('Titulo');
            echo $this->Form->input('Proceso_id', ['options' => $procesos]);
            echo $this->Form->input('Articulo_id', ['options' => $articulos]);
            echo $this->Form->input('Hasta', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
