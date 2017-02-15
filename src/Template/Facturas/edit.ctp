<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="tlf" id="seleccion"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <!-- $ -->
        <li><?= $this->Form->postLink(
                __('Eliminar'),
                ['action' => 'delete', $factura->id],
                ['confirm' => __('¿Confirma querer eliminar la factura {0}?', $factura->titulo)]
            )
            ?></li>
        <li><?= $this->Html->link(__('Facturas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Consumos'), ['controller' => 'Consumos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Agregar Consumo'), ['controller' => 'Consumos', 'action' => 'add'], ['class'=>'viewLink']) ?></li>
        <!-- $ -->
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="usu" ><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
    </ul>
</nav>
<div class="facturas form large-9 medium-8 columns content">
    <?= $this->Form->create($factura) ?>
    <fieldset>
        <legend><?= __('Editando Factura ').h($factura->titulo) ?></legend>
        <?php
            echo $this->Form->input('linea_id', ['options' => $lineas]);
            echo $this->Form->input('balance');
            echo $this->Form->input('iva');
            echo $this->Form->input('cargos_extra');
            echo $this->Form->input('numero_de_cuenta');
            echo $this->Form->input('desde',['minYear'=>1998,'maxYear'=>date("Y")]);
            echo $this->Form->input('hasta',['minYear'=>1998,'maxYear'=>2030]);
            echo $this->Form->input('paguese_antes_de', ['empty' => true]);

        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>
</div>
