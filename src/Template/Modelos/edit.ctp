<?=$this->assign('title',"Modelos y Marcas")?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Form->postLink(
                __('Eliminar'),
                ['action' => 'delete', $modelo->id],
                ['confirm' => __('¿Confirma querer eliminar el tipo de {0}?', $modelo->name)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Listar Modelos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Agregar Articulo'), ['controller' => 'Articulos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="modelos form large-9 medium-8 columns content">
    <?= $this->Form->create($modelo) ?>
    <fieldset>
        <legend><?= __('Editando el Modelo ').h($modelo->name) ?></legend>
        <?php
            echo $this->Form->input('marca');
            echo $this->Form->input('modelo');
            echo $this->Form->input('tipo_de_articulo');
            echo $this->Form->input('serial_comun');
            echo $this->Form->input('imagen');
            echo $this->Form->input('abstracto');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>
</div>
