<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="inv" id="seleccion"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <!-- $ -->
        <li><?= $this->Form->postLink(
                __('Eliminar Articulo'),
                ['action' => 'delete', $articulo->id],
                ['confirm' => __('¿Confirma querer eliminar el articulo {0}?', $articulo->titulo)]
            )
            ?></li>
        <li><?= $this->Html->link(__('Articulos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Modelos'), ['controller' => 'Modelos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Agregar Modelo'), ['controller' => 'Modelos', 'action' => 'add'], ['class'=>'viewLink']) ?></li>
        <li><?= $this->Html->link(__('Accesorios'), ['controller' => 'Accesorios', 'action' => 'index']) ?></li>
        <!-- $ -->
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="tlf"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <li class="usu"><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>

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
            echo $this->Form->input('ubicacion',['label'=>'Ubicacion Actual']);
            $options = ["Nuevo"=>"Nuevo",
                        "Usado"=>"Usado",
                        "Roto"=>"Roto",
                        "Reparado"=>"Reparado",
                        "Obsoleto"=>"Obsoleto"];
            echo $this->Form->input('estado', array('options'=>$options,'empty'=>false,'escape'=>false));
            echo $this->Form->input('fecha_de_compra', ['empty' => true,'minYear'=>1998,'maxYear'=>date("Y")]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>
</div>
