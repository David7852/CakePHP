<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
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
        <legend><?= __('Add Consumo') ?></legend>
        <?php
            echo $this->Form->input('Titulo');
            echo $this->Form->input('Factura_id', ['options' => $facturas]);
            echo $this->Form->input('Renta_id', ['options' => $rentas]);
            echo $this->Form->input('Consumido');
            echo $this->Form->input('Excedente');
            echo $this->Form->input('Monto_Bs');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
