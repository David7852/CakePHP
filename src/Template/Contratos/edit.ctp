<?=$this->assign('title',"Contratos de los trabajadores")?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="usu" id="seleccion"><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
        <!-- $ -->
        <li><?= $this->Form->postLink(
                __('Eliminar'),
                ['action' => 'delete', $contrato->id],
                ['confirm' => __('¿Confirma querer eliminar el contrato {0}?', $contrato->titulo)]
            )
            ?></li>
        <li><?= $this->Html->link(__('Contratos'), ['action' => 'index']) ?></li>
        <!-- $ -->
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="tlf"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
    </ul>
</nav>
<div class="contratos form large-9 medium-8 columns content">
    <?= $this->Form->create($contrato) ?>
    <fieldset>
        <legend><?= __('Editando el Contrato ').h($contrato->titulo) ?></legend>
        <?php
            echo $this->Form->input('trabajador_id', ['options' => $trabajadores]);
            $options = ['Temporal'=>'Temporal',
            'Permanente'=>'Permanente'];
            echo $this->Form->input('tipo_de_contrato',array('options'=>$options,'empty'=>false,'escape'=>false));
            echo $this->Form->input('fecha_de_inicio',['minYear'=>1998,'maxYear'=>date("Y")]);
            echo $this->Form->input('fecha_de_culminacion', ['empty' => true,'minYear'=>1998,'maxYear'=>2030]);

        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>
</div>
