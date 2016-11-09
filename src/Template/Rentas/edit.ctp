<?=$this->assign('title',"Rentas y Planes")?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Form->postLink(
                __('Eliminar ').h($renta->nombre),
                ['action' => 'delete', $renta->id],
                ['confirm' => __('¿Confirma querer eliminar la renta o plan {0}?', $renta->nombre)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Listar Rentas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Consumos'), ['controller' => 'Consumos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nuevo Consumo'), ['controller' => 'Consumos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nueva Linea'), ['controller' => 'Lineas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rentas form large-9 medium-8 columns content">
    <?= $this->Form->create($renta) ?>
    <fieldset>
        <legend><?= __('Editando ').h($renta->nombre) ?></legend>
        <?php
            echo $this->Form->input('nombre');
            echo $this->Form->input('monto_basico');
            $options = ['Movilnet'=>'Movilnet',
                        'Movistar'=>'Movistar'];
            echo $this->Form->input('operadora',array('options'=>$options,'type'=>'radio','empty'=>false,'escape'=>false));
            if (!empty($renta->lineas))
            echo $this->Form->input('lineas._ids', ['options' => $lineas]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>
</div>
