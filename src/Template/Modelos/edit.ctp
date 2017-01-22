<?=$this->assign('title',"Modelos y Marcas")?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="inv" id="seleccion"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <!-- $ -->
        <li><?= $this->Form->postLink(
                __('Eliminar'),
                ['action' => 'delete', $modelo->id],
                ['confirm' => __('¿Confirma querer eliminar el tipo de {0}?', $modelo->titulo)]
            )
            ?></li>
        <!-- $ -->
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="tlf"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <li class="usu"><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>

    </ul>
</nav>
<div class="modelos form large-9 medium-8 columns content">
    <?= $this->Form->create($modelo) ?>
    <fieldset>
        <legend><?= __('Editando el Modelo: ').h($modelo->titulo) ?></legend>
        <?php
            echo $this->Form->input('marca');
            echo $this->Form->input('modelo');
            echo $this->Form->input('tipo_de_articulo');
            /*echo $this->Form->input('serial_comun');*/
            $files = array_diff(scandir(getcwd()."\\img\\Modelos"), array('.', '..'));
            $images = array();
            foreach ($files as $i)
                $images[$i]=$i;
            echo '<div class="imageselecter">';
            echo str_replace('select name="imagen"', 'select name="imagen" onchange="refreshimage()"', $this->Form->input('imagen',array('options'=>$images,'size'=>13,'empty'=>false,'escape'=>false)));
            echo '<figure><img id="freshimage" class="center-image" src="/WIT/webroot/img/Modelos/'.reset($images).'"></figure>';
            echo '</div>';
            echo $this->Form->input('abstracto');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>
</div>
