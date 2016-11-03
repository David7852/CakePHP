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
    </ul>
</nav>
<div class="facturas form large-9 medium-8 columns content">
    <?= $this->Form->create($factura) ?>
    <fieldset>
        <legend><?= __('Edit Factura') ?></legend>
        <?php
            echo $this->Form->input('Titulo');
            echo $this->Form->input('Linea_id', ['options' => $lineas]);
            echo $this->Form->input('Paguese_Antes_De', ['empty' => true]);
            echo $this->Form->input('Balance');
            echo $this->Form->input('Desde');
            echo $this->Form->input('Hasta');
            echo $this->Form->input('Numero_De_Cuenta');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
