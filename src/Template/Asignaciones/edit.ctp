<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Form->postLink(
                __('Eliminar esta asignacion'),
                ['action' => 'delete', $asignacion->id],
                ['confirm' => __('¿Confirma querer eliminar la asignacion de {0}?', $asignacion->titulo)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Listar Asignaciones'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Procesos'), ['controller' => 'Procesos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nuevo Proceso'), ['controller' => 'Procesos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nuevo Articulo'), ['controller' => 'Articulos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="asignaciones form large-9 medium-8 columns content">
    <?= $this->Form->create($asignacion) ?>
    <fieldset>
        <legend><?= __('Editando Asignacion de ').h($asignacion->titulo) ?></legend>
        <?php
            echo $this->Form->input('titulo');
            echo $this->Form->input('proceso_id', ['options' => $procesos]);
            echo $this->Form->input('articulo_id', ['options' => $articulos]);
            echo $this->Form->input('hasta', ['empty' => true,'minYear'=>2010,'maxYear'=>2030]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>
</div>
