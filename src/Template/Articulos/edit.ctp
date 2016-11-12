<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Form->postLink(
                __('Eliminar este articulo'),
                ['action' => 'delete', $articulo->id],
                ['confirm' => __('¿Confirma querer eliminar el articulo {0}?', $articulo->titulo)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Listar Articulos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Modelos'), ['controller' => 'Modelos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nuevo Modelo'), ['controller' => 'Modelos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Accesorios'), ['controller' => 'Accesorios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nuevo Accesorio'), ['controller' => 'Accesorios', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Asignaciones'), ['controller' => 'Asignaciones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Formar Asignacion'), ['controller' => 'Asignaciones', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Devoluciones'), ['controller' => 'Devoluciones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Formar Devolucion'), ['controller' => 'Devoluciones', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nueva Linea'), ['controller' => 'Lineas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="articulos form large-9 medium-8 columns content">
    <?= $this->Form->create($articulo) ?>
    <fieldset>
        <legend><?= __('Editando Articulo ').h($articulo->titulo) ?></legend>
        <?php
            echo $this->Form->input('serial');
            echo $this->Form->input('modelo_id', ['options' => $modelos]);
            if($articulo->datos!=''||$articulo->modelo->abstracto!='')
                echo $this->Form->input('datos');
            echo $this->Form->input('ubicacion');
            $options = ["Nuevo"=>"Nuevo",
                        "Usado"=>"Usado",
                        "Roto"=>"Roto",
                        "Reparado"=>"Reparado",
                        "Obsoleto"=>"Obsoleto"];
            echo $this->Form->input('estado', array('options'=>$options,'empty'=>false,'escape'=>false));
            echo $this->Form->input('fecha_de_compra', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>
</div>
