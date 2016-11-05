<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $renta->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $renta->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Rentas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Consumos'), ['controller' => 'Consumos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Consumo'), ['controller' => 'Consumos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Linea'), ['controller' => 'Lineas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rentas form large-9 medium-8 columns content">
    <?= $this->Form->create($renta) ?>
    <fieldset>
        <legend><?= __('Edit Renta') ?></legend>
        <?php
            echo $this->Form->input('nombre');
            echo $this->Form->input('monto_basico');
            echo $this->Form->input('operadora');
            echo $this->Form->input('lineas._ids', ['options' => $lineas]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
