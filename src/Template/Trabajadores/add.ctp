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
            echo $this->Form->input('Nombre');
            echo $this->Form->input('Apellido');
            echo $this->Form->input('Cedula');
            echo $this->Form->input('Gerencia');
            echo $this->Form->input('Cargo');
            echo $this->Form->input('Sede');
            echo $this->Form->input('Numero_De_Oficina');
            echo $this->Form->input('Telefono_Personal');
            echo $this->Form->input('Rif');
            echo $this->Form->input('Residencia');
            echo $this->Form->input('procesos._ids', ['options' => $procesos]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
