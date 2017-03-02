<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="sol" id="seleccion"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <!-- $ -->
        <?php if(!$this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
            <li><?= $this->Html->link(__('Agregar Proceso'), ['action' => 'add'], ['class'=>'viewLink']) ?></li>
            <li><?= $this->Html->link(__('Asignaciones'), ['controller' => 'Asignaciones', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('Devoluciones'), ['controller' => 'Devoluciones', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('Trabajadores'), ['controller' => 'Trabajadores', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?></li>
        <?php else: ?>
            <li><?= $this->Html->link(__('Solicitar'), ['action' => 'solicitar']) ?></li>
            <li><?= $this->Html->link(__('Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?></li>
        <?php endif; ?>
        <!-- $ -->
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="tlf"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <li class="usu"><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
    </ul>
</nav>
<div class="procesos index large-9 medium-8 columns content">
    <h3><?= __('Procesos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort(' ') ?></th>
                <th scope="col"><?= $this->Paginator->sort('motivo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('solicitante') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Supervisor') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created',['label'=>'Fecha de Solicitud']) ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($procesos as $proceso): ?>
            <tr>
                <?php
                $titulo= $proceso->tipo.' '.$proceso->estado;
                if($proceso->tipo!='Mixto')
                {
                    if(substr($titulo,-1)=="o")
                        $titulo=substr($titulo,0,-1)."a";
                }
                if($proceso->estado=='Pendiente')
                    echo "<td id='pendiente'>".$titulo."</td>";
                if($proceso->estado=='Aprobado')
                    echo "<td id='aprobado'>".$titulo."</td>";
                if($proceso->estado=='Rechazado')
                    echo "<td id='rechazado'>".$titulo."</td>";
                if($proceso->estado=='Completado')
                    echo "<td id='completado'>".$titulo."</td>";
                ?>
                <td><?= h($proceso->motivo) ?></td>
                <td><?= $proceso->solicitanteid!=null ? $this->Html->link($proceso->solicitante, ['controller'=> 'Trabajadores','action' => 'view', $proceso->solicitanteid]):'Sin solicitante' ?></td>
                <td><?= $proceso->supervisorid!=null ? $this->Html->link($proceso->supervisor, ['controller'=> 'Trabajadores','action' => 'view', $proceso->supervisorid]):'Sin supervisor' ?></td>
                <td><?= h($proceso->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $proceso->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $proceso->id]) ?>
                <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?><!-->
                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $proceso->id], ['confirm' => __('¿Confirma querer eliminar el proceso {0}?', $proceso->motivo)]) ?>
                <?php endif; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('<')) ?>
            <?= str_replace("of","de",$this->Paginator->numbers()) ." ". str_replace("of","de",$this->Paginator->counter()) ?>
            <?= $this->Paginator->next(__('>') . ' >') ?>
        </ul>

    </div>
</div>
