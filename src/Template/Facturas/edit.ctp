<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $factura->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $factura->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Facturas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Linea'), ['controller' => 'Lineas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Consumos'), ['controller' => 'Consumos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Consumo'), ['controller' => 'Consumos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="facturas form large-9 medium-8 columns content">
    <?= $this->Form->create($factura) ?>
    <fieldset>
        <legend><?= __('Edit Factura') ?></legend>
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
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
