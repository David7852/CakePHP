<?=$this->assign('title',"Contratos de los trabajadores")?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Listar Contratos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Trabajadores'), ['controller' => 'Trabajadores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nuevo Trabajador'), ['controller' => 'Trabajadores', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="contratos form large-9 medium-8 columns content">
    <?= $this->Form->create($contrato) ?>
    <fieldset>
        <legend><?= __('Nuevo Contrato') ?></legend>
        <?php
            echo $this->Form->input('trabajador_id', ['options' => $trabajadores]);
            echo $this->Form->input('fecha_de_inicio');
            echo $this->Form->input('fecha_de_culminacion', ['empty' => true]);
            $options = ['Temporal'=>'Temporal',
                        'Permanente'=>'Permanente'];
            echo $this->Form->input('tipo_de_contrato',array('options'=>$options,'empty'=>false,'escape'=>false));

        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>
</div>
