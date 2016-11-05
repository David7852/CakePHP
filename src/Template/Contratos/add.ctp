<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Contratos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Trabajadores'), ['controller' => 'Trabajadores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Trabajador'), ['controller' => 'Trabajadores', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="contratos form large-9 medium-8 columns content">
    <?= $this->Form->create($contrato) ?>
    <fieldset>
        <legend><?= __('Add Contrato') ?></legend>
        <?php
            echo $this->Form->input('Titulo');
            echo $this->Form->input('Trabajador_id', ['options' => $trabajadores]);
            echo $this->Form->input('Fecha_De_Inicio');
            echo $this->Form->input('Fecha_De_Culminacion', ['empty' => true]);
            echo $this->Form->input('Tipo_De_Contrato');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
