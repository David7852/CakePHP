<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Listar Procesos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Asignaciones'), ['controller' => 'Asignaciones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Formar Asignacion'), ['controller' => 'Asignaciones', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Devoluciones'), ['controller' => 'Devoluciones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Formar Devolucion'), ['controller' => 'Devoluciones', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Trabajadores'), ['controller' => 'Trabajadores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nuevo Trabajador'), ['controller' => 'Trabajadores', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="procesos form large-9 medium-8 columns content">
    <?= $this->Form->create($proceso) ?>
    <fieldset>
        <legend><?= __('Asignacion telefonica') ?></legend>
        <?php
        echo $this->Form->input('motivo',['default'=>'Asignar telefono movil a...']);
        echo $this->Form->input('observaciones');
        $options = ['Asignacion'=>'Asignacion'];
        echo $this->Form->input('tipo',array('options'=>$options,'empty'=>false,'escape'=>false));
        echo $this->Form->input('solicitantes', ['options' => $solicitantes,'label'=>'Solicitante o beneficiado']);
        echo $this->Form->input('articulo_id', ['options' => $articulos]);
        echo $this->Form->input('hasta', ['type'=>'date','empty' => false,'minYear'=>2010,'maxYear'=>2030]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>
</div>
