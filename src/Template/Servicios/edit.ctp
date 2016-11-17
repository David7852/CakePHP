<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Form->postLink(
                __('Eliminar este servicio'),
                ['action' => 'delete', $servicio->id],
                ['confirm' => __('¿Confirma querer eliminar el servicio {0}?', $servicio->titulo)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Listar Servicios'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Rentas'), ['controller' => 'Rentas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nueva Renta'), ['controller' => 'Rentas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Consumos'), ['controller' => 'Consumos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nuevo Consumo'), ['controller' => 'Consumos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="servicios form large-9 medium-8 columns content">
    <?= $this->Form->create($servicio) ?>
    <fieldset>
        <legend><?= __('Editando el Servicio ').h($servicio->titulo) ?></legend>
        <?php
            echo $this->Form->input('nombre');
            echo $this->Form->input('cupo');
            echo $this->Form->input('renta_id', ['options' => $rentas]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>
</div>
