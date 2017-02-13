<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="tlf" id="seleccion"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <!-- $ -->
        <li><?= $this->Html->link(__('Lineas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Celulares'), ['controller' => 'Articulos', 'action' => 'inventario','0Celular']) ?></li>
        <!-- $ -->
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="usu" ><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
    </ul>
</nav>
<div class="lineas form large-9 medium-8 columns content">
    <?= $this->Form->create($linea) ?>
    <fieldset>
        <legend><?= __('Nueva Linea') ?></legend>
        <?php
            $options = ['Movilnet'=>'Movilnet',
                        'Movistar'=>'Movistar'];
            echo $this->Form->input('operadora',array('options'=>$options,'empty'=>false,'escape'=>false));
            echo $this->Form->input('numero');//Esto, al igual que el genero de los trabajadores, requiere consulta post
            echo $this->Form->input('puk');
            echo $this->Form->input('pin');
            echo $this->Form->input('codigo_sim');
            echo $this->Form->input('articulo_id', ['options' => $articulos, 'empty' => true]);
            $options = ['Activa'=>'Activa',
                        'Inactiva'=>'Inactiva',
                        'Suspendida'=>'Suspendida',
                        'Perdida'=>'Perdida'];
            echo $this->Form->input('estado',array('options'=>$options,'empty'=>false,'escape'=>false));
            echo $this->Form->input('observaciones');
            echo $this->Form->input('rentas._ids', ['options' => $rentas]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>
</div>
