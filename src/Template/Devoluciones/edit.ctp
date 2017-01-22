<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>

        <li class="sol" id="seleccion"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <!-- $ -->
        <li><?= $this->Form->postLink(
                __('Eliminar Devolucion'),
                ['action' => 'delete', $devolucion->id],
                ['confirm' => __('¿Confirma querer eliminar la devolucion {0}?', $devolucion->titulo)]
            )
            ?></li>
        <li><?= $this->Html->link(__('Devoluciones'), ['action' => 'index']) ?></li>
        <!-- $ -->
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="tlf"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <li class="usu"><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
    </ul>
</nav>
<div class="devoluciones form large-9 medium-8 columns content">
    <?= $this->Form->create($devolucion) ?>
    <fieldset>
        <legend><?= __('Editando Devolucion ').h($devolucion->titulo) ?></legend>
        <?php
            echo $this->Form->input('proceso_id', ['options' => $procesos]);
            echo $this->Form->input('articulo_id', ['options' => $articulos]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>
</div>
