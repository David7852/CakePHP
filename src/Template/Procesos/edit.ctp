<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $proceso->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $proceso->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Procesos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Asignaciones'), ['controller' => 'Asignaciones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Asignacion'), ['controller' => 'Asignaciones', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Devoluciones'), ['controller' => 'Devoluciones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Devolucion'), ['controller' => 'Devoluciones', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Trabajadores'), ['controller' => 'Trabajadores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Trabajador'), ['controller' => 'Trabajadores', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="procesos form large-9 medium-8 columns content">
    <?= $this->Form->create($proceso) ?>
    <fieldset>
        <legend><?= __('Edit Proceso') ?></legend>
        <?php
            echo $this->Form->input('titulo');
            echo $this->Form->input('motivo');
            echo $this->Form->input('tipo');
            echo $this->Form->input('fecha_de_solicitud');
            echo $this->Form->input('fecha_de_aprobacion', ['empty' => true]);
            echo $this->Form->input('estado');
            echo $this->Form->input('observaciones');
            echo $this->Form->input('trabajadores._ids', ['options' => $trabajadores]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
