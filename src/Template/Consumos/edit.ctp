<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="tlf" id="seleccion"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <!-- $ -->
        <li><?= $this->Form->postLink(
                __('Eliminar'),
                ['action' => 'delete', $consumo->id],
                ['confirm' => __('¿Confirma querer eliminar el consumo {0}?', $consumo->titulo)]
            )
            ?></li>
        <li><?= $this->Html->link(__('Consumos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Facturas'), ['controller' => 'Facturas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Servicios'), ['controller' => 'Servicios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Rentas'), ['controller' => 'Rentas', 'action' => 'index']) ?></li>
        <!-- $ -->
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="usu" ><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
    </ul>
</nav>
<div class="consumos form large-9 medium-8 columns content">
    <?= $this->Form->create($consumo) ?>
    <fieldset>
        <legend><?= __('Editando Consumo ').h($consumo->titulo) ?></legend>
        <?php
        echo $this->Form->input('factura_id', ['options' => $facturas]);
        echo $this->Form->input('servicio_id', ['options' => $servicios]);
        echo $this->Form->input('consumido');
        echo $this->Form->input('excedente');
        echo $this->Form->input('monto');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>
</div>
