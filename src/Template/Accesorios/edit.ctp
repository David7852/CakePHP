<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Form->postLink(
                __('Eliminar ').h($accesorio->titulo),
                ['action' => 'delete', $accesorio->id],
                ['confirm' => __('¿Confirma querer eliminar el accesorio: {0}?', $accesorio->titulo)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Listar Accesorios'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nuevo Articulo'), ['controller' => 'Articulos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="accesorios form large-9 medium-8 columns content">
    <?= $this->Form->create($accesorio) ?>
    <fieldset>
        <legend><?= __('Editando ').h($accesorio->titulo) ?></legend>
        <?php
            echo $this->Form->input('descripcion');
            $options = ["Nuevo"=>"Nuevo",
                "Usado"=>"Usado",
                "Roto"=>"Roto",
                "Reparado"=>"Reparado",
                "Obsoleto"=>"Obsoleto"];
            echo $this->Form->input('estado', array('options'=>$options,'empty'=>false,'escape'=>false));
            echo $this->Form->input('articulo_id', ['options' => $articulos, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>
</div>
