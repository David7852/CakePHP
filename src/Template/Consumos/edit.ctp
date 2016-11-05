<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $consumo->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $consumo->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Consumos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Facturas'), ['controller' => 'Facturas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Factura'), ['controller' => 'Facturas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Rentas'), ['controller' => 'Rentas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Renta'), ['controller' => 'Rentas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="consumos form large-9 medium-8 columns content">
    <?= $this->Form->create($consumo) ?>
    <fieldset>
        <legend><?= __('Edit Consumo') ?></legend>
        <?php
            echo $this->Form->input('titulo');
            echo $this->Form->input('factura_id', ['options' => $facturas]);
            echo $this->Form->input('renta_id', ['options' => $rentas]);
            echo $this->Form->input('consumido');
            echo $this->Form->input('excedente');
            echo $this->Form->input('monto_bs');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
