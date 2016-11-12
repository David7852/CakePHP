<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Form->postLink(
                __('Eliminar este consumo'),
                ['action' => 'delete', $consumo->id],
                ['confirm' => __('¿Confirma querer eliminar el consumo {0}?', $consumo->titulo)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Listar Consumos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Facturas'), ['controller' => 'Facturas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nueva Factura'), ['controller' => 'Facturas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Rentas'), ['controller' => 'Rentas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nueva Renta'), ['controller' => 'Rentas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="consumos form large-9 medium-8 columns content">
    <?= $this->Form->create($consumo) ?>
    <fieldset>
        <legend><?= __('Editando Consumo ').h($consumo->titulo) ?></legend>
        <?php
            echo $this->Form->input('factura_id', ['options' => $facturas]);
            echo $this->Form->input('renta_id', ['options' => $rentas]);
            echo $this->Form->input('consumido');
            echo $this->Form->input('excedente');
            echo $this->Form->input('monto');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>
</div>
