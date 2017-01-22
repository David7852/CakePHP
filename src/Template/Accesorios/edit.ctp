<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="inv" id="seleccion"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <!-- $ -->
        <li><?= $this->Form->postLink(__('Eliminar Accesorio'),['action' => 'delete', $accesorio->id],['confirm' => __('¿Confirma querer eliminar el accesorio: {0}?', $accesorio->titulo)])?></li>
        <li><?= $this->Html->link(__('Accesorios'), ['action' => 'index']) ?></li>
        <!-- $ -->
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="tlf"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <li class="usu"><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
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
