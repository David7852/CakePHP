<?=$this->assign('title',"Rentas y Planes")?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">


        <li class="heading"><?=''?></li>
        <li class="tlf" id="seleccion"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <!-- $ -->
        <li><?= $this->Html->link(__('Rentas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Servicios'), ['controller' => 'Servicios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Agregar Servicio'), ['controller' => 'Servicios', 'action' => 'add'], ['class'=>'viewLink']) ?></li>
        <li><?= $this->Html->link(__('Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Agregar Linea'), ['controller' => 'Lineas', 'action' => 'add'], ['class'=>'viewLink']) ?></li>
        <!-- $ -->
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="usu" ><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
    </ul>
</nav>
<div class="rentas form large-9 medium-8 columns content">
    <?= $this->Form->create($renta) ?>
    <fieldset>
        <legend><?= __('Nueva Renta') ?></legend>
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
