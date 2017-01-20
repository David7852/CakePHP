<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Form->postLink(
                __('Eliminar este proceso'),
                ['action' => 'delete', $proceso->id],
                ['confirm' => __('¿Confirma querer eliminar el proceso {0}?', $proceso->motivo)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Listar Procesos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Asignaciones'), ['controller' => 'Asignaciones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Formar Asignacion'), ['controller' => 'Asignaciones', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Devoluciones'), ['controller' => 'Devoluciones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Formar Devolucion'), ['controller' => 'Devoluciones', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Trabajadores'), ['controller' => 'Trabajadores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nuevo Trabajador'), ['controller' => 'Trabajadores', 'action' => 'add']) ?></li>
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
