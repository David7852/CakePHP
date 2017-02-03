<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="sol" id="seleccion"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <!-- $ -->
        <li><?= $this->Html->link(__('Procesos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?></li>
        <!-- $ -->
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="tlf"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <li class="usu"><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
    </ul>
</nav>
<div class="procesos form large-9 medium-8 columns content">
    <?= $this->Form->create($proceso) ?>
    <fieldset>
        <legend><?= __('Solicitud de procesos') ?></legend>
        <?php
        echo $this->Form->input('motivo');
        echo $this->Form->input('observaciones');
        $options = ['Asignacion'=>'Asignacion',
            'Devolucion'=>'Devolucion',
            'Mixto'=>'Mixto'];
        echo $this->Form->input('tipo',array('options'=>$options,'empty'=>false,'escape'=>false));
        echo "<p class='removablewarningnote' id='removable' onclick='removeFadeOut(document.getElementById(\"removable\"), 666);'>Su solicitud sera evaluada por el personal de IT antes de hacerse efectiva.</p>";
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>
</div>
