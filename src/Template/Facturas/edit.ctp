<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Form->postLink(
                __('Eliminar esta factura'),
                ['action' => 'delete', $factura->id],
                ['confirm' => __('¿Confirma querer eliminar la factura {0}?', $factura->titulo)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Listar Facturas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nueva Linea'), ['controller' => 'Lineas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Consumos'), ['controller' => 'Consumos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nuevo Consumo'), ['controller' => 'Consumos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="facturas form large-9 medium-8 columns content">
    <?= $this->Form->create($factura) ?>
    <fieldset>
        <legend><?= __('Editando Factura ').h($factura->titulo) ?></legend>
        <?php
            echo $this->Form->input('titulo');
            echo $this->Form->input('linea_id', ['options' => $lineas]);
            echo $this->Form->input('paguese_antes_de', ['empty' => true]);
            echo $this->Form->input('balance');
            echo $this->Form->input('desde');
            echo $this->Form->input('hasta');
            echo $this->Form->input('numero_de_cuenta');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>
</div>
