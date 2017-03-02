<?php use Cake\Routing\Router;
use Cake\ORM\TableRegistry;?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="sol" id="seleccion"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <!-- $ -->
        <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
            <li><?= $this->Html->link(__('Asignaciones'), ['controller' => 'Asignaciones', 'action' => 'index', $this->request->session()->read('Auth.User.trabajador_id')]) ?></li>
            <li><?= $this->Html->link(__('Devoluciones'), ['controller' => 'Devoluciones', 'action' => 'index', $this->request->session()->read('Auth.User.trabajador_id')]) ?></li>
        <?php else: ?>
            <?php if($proceso->tipo=='Asignacion'): ?>
                <li><?= $this->Html->link(__('Dar Asignacion'), ['controller' => 'Asignaciones', 'action' => 'asociar',$proceso->id],['id'=>'asignacion']) ?> </li>
                <li><?= $this->Html->link(__('Planilla'), ['action' => 'planilla',$proceso->id],['style'=>'color:#D7782E']) ?></li>
                <li><?= $this->Html->link(__('Editar'), ['action' => 'edit', $proceso->id]) ?></li>
                <li><?= $this->Html->link(__('Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('Procesos'), ['action' => 'index']) ?></li>
            <?php elseif($proceso->tipo=='Devolucion'):?>
                <li><?= $this->Html->link(__('Dar Devolucion'), ['controller' => 'Devoluciones', 'action' => 'asociar',$proceso->id],['id'=>'devolucion']) ?> </li>
                <li><?= $this->Html->link(__('Planilla'), ['action' => 'planilla',$proceso->id],['style'=>'color:#D7782E']) ?></li>
                <li><?= $this->Html->link(__('Editar'), ['action' => 'edit', $proceso->id]) ?></li>
                <li><?= $this->Html->link(__('Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('Procesos'), ['action' => 'index']) ?></li>
            <?php else: ?>
                <li><?= $this->Html->link(__('Dar Asignacion'), ['controller' => 'Asignaciones', 'action' => 'asociar',$proceso->id],['id'=>'asignacion']) ?> </li>
                <li><?= $this->Html->link(__('Dar Devolucion'), ['controller' => 'Devoluciones', 'action' => 'asociar',$proceso->id],['id'=>'devolucion']) ?> </li>
                <li><?= $this->Html->link(__('Planilla'), ['action' => 'planilla',$proceso->id],['style'=>'color:#D7782E']) ?></li>
                <li><?= $this->Html->link(__('Editar'), ['action' => 'edit', $proceso->id]) ?></li>
                <li><?= $this->Html->link(__('Procesos'), ['action' => 'index']) ?></li>

            <?php endif; ?>
        <?php endif; ?>

        <!-- $ -->
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="tlf"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <li class="usu"><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
    </ul>
</nav>
<div class="procesos view large-9 medium-8 columns content">
    <div class="row">
        <h3><?= h(ucfirst($proceso->motivo)) ?></h3>
        <?= $this->Text->autoParagraph(h($proceso->observaciones)); ?>
    </div>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Fecha De Solicitud') ?></th>
            <td><?= h($proceso->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha De Aprobacion') ?></th>
            <td>
                <?php if($proceso->fecha_de_aprobacion!=''):?>
                    <?= h($proceso->fecha_de_aprobacion) ?>
                <?php else: ?>
                    <?= h('Sin aprobar') ?>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha De Compleción') ?></th>
            <td>
                <?php if($proceso->fecha_de_complecion!=''):?>
                    <?= h($proceso->fecha_de_complecion) ?>
                <?php else: ?>
                    <?= h('Sin completar') ?>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estado') ?></th>
            <td><?= h($proceso->estado) ?></td>
        </tr>
        <tr><!-- Es tipo necesario?... El titulo debería comenzar con el tipo. -->
            <th scope="row"><?= __('Tipo') ?></th>
            <td><?= h($proceso->tipo) ?></td>
        </tr>
    </table>


    <?php if (!empty($proceso->asignaciones)): ?>
    <div class="related">
        <h4><?= __('Asignaciones') ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Articulo') ?></th>
                <th scope="col"><?= __('Hasta') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($proceso->asignaciones as $asignaciones): ?>
            <tr>
                <td><?= $this->Html->link($asignaciones->art, ['controller' => 'Articulos', 'action' => 'view', $asignaciones->articulo_id]) ?></td>
                <td><?= h($asignaciones->hasta) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Asignaciones', 'action' => 'view', $asignaciones->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Asignaciones', 'action' => 'edit', $asignaciones->id]) ?>
                <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?><!-->
                    <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Asignaciones', 'action' => 'delete', $asignaciones->id], ['confirm' => __('¿Confirma querer eliminar la asignacion del{0}?', $asignaciones->titulo)]) ?>
                <?php endif; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php elseif($proceso->tipo=='Asignacion'||$proceso->tipo=='Mixto'): ?>
    <h3><?= h('El proceso aun no tiene Asignaciones.') ?></h3>
    <?php endif; ?>
    <?php if (!empty($proceso->devoluciones)): ?>
    <div class="related">
        <h4><?= __('Devoluciones') ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Articulo') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($proceso->devoluciones as $devoluciones): ?>
            <tr>
                <td><?= $this->Html->link($devoluciones->art, ['controller' => 'Articulos', 'action' => 'view', $devoluciones->articulo_id]) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Devoluciones', 'action' => 'view', $devoluciones->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Devoluciones', 'action' => 'edit', $devoluciones->id]) ?>
                <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?><!-->
                    <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Devoluciones', 'action' => 'delete', $devoluciones->id], ['confirm' => __('¿Confirma querer eliminar la devolucion del {0}?', $devoluciones->titulo)]) ?>
                <?php endif; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php elseif($proceso->tipo=='Devolucion'||$proceso->tipo=='Mixto'): ?>
        <h4><?= h('El proceso aun no tiene Devoluciones.') ?></h4>
    <?php endif; ?>
    <?php if (!empty($proceso->trabajadores)): ?>
    <div class="related">
        <h4><?= __('Personal involucrado:') ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Rol') ?></th>
                <th scope="col"><?= __('Nombre') ?></th>
                <th scope="col"><?= __('Cedula') ?></th>
                <th scope="col"><?= __('Gerencia') ?></th>
                <th scope="col"><?= __('Cargo') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($proceso->trabajadores as $trabajadores): ?>
            <tr>
                <td><?php
                    $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
                        ->where(['proceso_id ='=>$proceso->id])
                        ->andWhere(['trabajador_id =' => $trabajadores->id]);
                    if($pro_tra!=null)
                        echo $pro_tra->first()->rol;
                    else
                        echo 'Indefinido';
                ?></td>
                <td><?= h($trabajadores->nombre.' '.$trabajadores->apellido) ?></td>
                <td><?= h($trabajadores->cedula) ?></td>
                <td><?= h($trabajadores->gerencia) ?></td>
                <td><?= h($trabajadores->cargofix) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Trabajadores', 'action' => 'view', $trabajadores->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
</div>
