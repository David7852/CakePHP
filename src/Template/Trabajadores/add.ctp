<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Trabajadores'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Contratos'), ['controller' => 'Contratos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Contrato'), ['controller' => 'Contratos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Procesos'), ['controller' => 'Procesos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Proceso'), ['controller' => 'Procesos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="trabajadores form large-9 medium-8 columns content">
    <?= $this->Form->create($trabajador) ?>
    <fieldset>
        <legend><?= __('Add Trabajador') ?></legend>
        <?php
            echo $this->Form->input('nombre');
            echo $this->Form->input('apellido');
            echo $this->Form->input('cedula');
            echo $this->Form->input('sexo');
            echo $this->Form->input('gerencia');
            echo $this->Form->input('cargo');
            echo $this->Form->input('sede');
            echo $this->Form->input('numero_de_oficina');
            echo $this->Form->input('telefono_personal');
            echo $this->Form->input('rif');
            echo $this->Form->input('residencia');
            echo $this->Form->input('procesos._ids', ['options' => $procesos]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
