<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="sol" id="seleccion"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <!-- $ -->
        <li><?= $this->Form->postLink(
                __('Eliminar'),
                ['action' => 'delete', $proceso->id],
                ['confirm' => __('¿Confirma querer eliminar el proceso {0}?', $proceso->motivo)]
            )
            ?></li>
        <li><?= $this->Html->link(__('Procesos'), ['action' => 'index']) ?></li>
        <!-- $ -->
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="tlf"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <li class="usu"><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
    </ul>
</nav>
<div class="procesos form large-9 medium-8 columns content">
    <?= $this->Form->create($proceso) ?>
    <fieldset>
        <legend><?= __('Editando el proceso de ').h($proceso->titulo) ?></legend>
        <?php
            echo $this->Form->input('motivo');
            $options = ['Asignacion'=>'Asignacion',
                'Devolucion'=>'Devolucion',
                'Mixto'=>'Mixto'];
            echo $this->Form->input('tipo',array('options'=>$options,'empty'=>false,'escape'=>false));
            if($proceso->estado==null||$proceso->estado=='Pendiente')
                $options = ['Pendiente'=>'Pendiente',
                    'Aprobado'=>'Aprobado',
                    'Rechazado'=>'Rechazado',
                    'Completado'=>'Completado'];
            elseif($proceso->estado=='Aprobado')
                $options = ['Aprobado'=>'Aprobado',
                    'Rechazado'=>'Rechazado',
                    'Completado'=>'Completado'];
            elseif($proceso->estado=='Completado')
                $options = ['Completado'=>'Completado'];
            else
                $options = ['Rechazado'=>'Rechazado'];
            echo $this->Form->input('estado',array('options'=>$options,'empty'=>false,'escape'=>false));
            echo $this->Form->input('observaciones');
            echo $this->Form->input('trabajadores._ids', ['label'=>'Encargados','options' => $trabajadores]);
            echo $this->Form->input('solicitantes',['label'=>'Solicitante','options'=>$solicitantes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>
</div>
