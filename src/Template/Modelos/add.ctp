<?=$this->assign('title',"Modelos y Marcas")?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Listar Modelos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Agregar Articulo'), ['controller' => 'Articulos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="modelos form large-9 medium-8 columns content">
    <?= $this->Form->create($modelo) ?>
    <fieldset>
        <legend><?= __('Agregar Modelo') ?></legend>
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
        echo "<p class='removablewarningnote' id='removable' onclick='removeFadeOut(document.getElementById(\"removable\"), 666);'>Puede especificar si este nuevo tipo de articulo requiere información adicional escribiendo el nombre del dato en el campo 'abstracto'.<br>Por ejemplo: el abstracto de un carro modelo toyota corolla seria su placa; el de un celular, su IMEI.</p>";
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>
</div>