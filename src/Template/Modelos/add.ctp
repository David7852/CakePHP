<?=$this->assign('title',"Modelos y Marcas")?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Listar Modelos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Agregar Articulo'), ['controller' => 'Articulos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="modelos form large-9 medium-8 columns content">
    <?= $this->Form->create($modelo) ?>
    <fieldset>
        <legend><?= __('Agregar Modelo') ?></legend>
        <?php
            echo $this->Form->input('marca');
            echo $this->Form->input('modelo');
            echo $this->Form->input('tipo_de_articulo');
            echo $this->Form->input('serial_comun');
            echo $this->Form->input('imagen');
            echo $this->Form->input('abstracto');
        ?>
        <small><?=h("(!) Puede especificar si este nuevo tipo de articulo requiere informacion adicional, escribiendo el nombre del dato en el campo 'abstracto'.");?></small><br>
        <small><?=h("Por ejemplo: el abstracto de un carro modelo toyota corolla seria su placa; el de un celular, su IMEI.");?></small>
    </fieldset>

    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>
</div>
