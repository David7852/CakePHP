<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>

        <li class="sol" id="seleccion"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <!-- $ -->
        <li><?= $this->Html->link(__('Asignaciones'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Procesos'), ['controller' => 'Procesos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Agregar Proceso'), ['controller' => 'Procesos', 'action' => 'add'], ['class'=>'viewLink']) ?></li>
        <li><?= $this->Html->link(__('Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Agregar Articulo'), ['controller' => 'Articulos', 'action' => 'add'], ['class'=>'viewLink']) ?></li>
        <!-- $ -->
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="tlf"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <li class="usu"><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
    </ul>
</nav>
<div class="asignaciones form large-9 medium-8 columns content">
    <?= $this->Form->create($asignacion) ?>
    <fieldset>
        <legend><?= __('Formar Asignacion') ?></legend>
        <?php
            echo $this->Form->input('proceso_id', ['options' => $procesos]);
            echo $this->Form->input('articulo_id', ['options' => $articulos]);
            echo $this->Form->input('hasta', ['empty' => false,'minYear'=>2010,'maxYear'=>2030]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>
</div>
