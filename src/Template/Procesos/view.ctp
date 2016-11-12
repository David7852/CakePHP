<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Editar este Proceso'), ['action' => 'edit', $proceso->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Eliminar este Proceso'), ['action' => 'delete', $proceso->id], ['confirm' => __('¿Confirma querer eliminar el proceso {0}?', $proceso->titulo)]) ?> </li>
        <li><?= $this->Html->link(__('Listar Procesos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Proceso'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Asignaciones'), ['controller' => 'Asignaciones', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Asignacion'), ['controller' => 'Asignaciones', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Devoluciones'), ['controller' => 'Devoluciones', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Devolucion'), ['controller' => 'Devoluciones', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Trabajadores'), ['controller' => 'Trabajadores', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Trabajador'), ['controller' => 'Trabajadores', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="procesos view large-9 medium-8 columns content">
    <h3><?= 'Proceso '.h($proceso->titulo) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Motivo') ?></th>
            <td><?= h($proceso->motivo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha De Solicitud') ?></th>
            <td><?= h($proceso->fecha_de_solicitud) ?></td>
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
            <th scope="row"><?= __('Estado') ?></th>
            <td><?= h($proceso->estado) ?></td>
        </tr>
        <tr><!-- Es tipo necesario?... El titulo debería comenzar con el tipo. -->
            <th scope="row"><?= __('Tipo') ?></th>
            <td><?= h($proceso->tipo) ?></td>
        </tr>
    </table>

    <div class="row">
        <h4><?= __('Observaciones') ?></h4>
        <?= $this->Text->autoParagraph(h($proceso->observaciones)); ?>
    </div>
    <?php if (!empty($proceso->asignaciones)): ?>
    <div class="related">
        <h4><?= __('Asignaciones') ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Articulo Id') ?></th>
                <th scope="col"><?= __('Hasta') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($proceso->asignaciones as $asignaciones): ?>
            <tr>
                <td><?= h($asignaciones->articulo_id) ?></td>
                <td><?= h($asignaciones->hasta) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Asignaciones', 'action' => 'view', $asignaciones->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Asignaciones', 'action' => 'edit', $asignaciones->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Asignaciones', 'action' => 'delete', $asignaciones->id], ['confirm' => __('¿Confirma querer eliminar la asignacion del{0}?', $asignaciones->titulo)]) ?>
                </td>
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
                <th scope="col"><?= __('Articulo Id') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($proceso->devoluciones as $devoluciones): ?>
            <tr>
                <td><?= h($devoluciones->articulo_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Devoluciones', 'action' => 'view', $devoluciones->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Devoluciones', 'action' => 'edit', $devoluciones->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Devoluciones', 'action' => 'delete', $devoluciones->id], ['confirm' => __('¿Confirma querer eliminar la devolucion del {0}?', $devoluciones->titulo)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php elseif($proceso->tipo=='Devolucion'||$proceso->tipo=='Mixto'): ?>
        <h3><?= h('El proceso aun no tiene Devoluciones.') ?></h3>
    <?php endif; ?>
    <?php if (!empty($proceso->trabajadores)): ?>
    <div class="related">
        <h3><?= __('Personal involucrado:') ?></h3>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <!-- Aca podria ir el rol del trabajador -->
                <th scope="col"><?= __('Nombre') ?></th>
                <th scope="col"><?= __('Apellido') ?></th>
                <th scope="col"><?= __('Cedula') ?></th>
                <th scope="col"><?= __('Gerencia') ?></th>
                <th scope="col"><?= __('Cargo') ?></th>
                <th scope="col"><?= __('Sede') ?></th>
                <th scope="col"><?= __('Numero De Oficina') ?></th>
                <th scope="col"><?= __('Telefono Personal') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($proceso->trabajadores as $trabajadores): ?>
            <tr>
                <!-- Aca podria ir el rol del trabajador -->
                <td><?= h($trabajadores->nombre) ?></td>
                <td><?= h($trabajadores->apellido) ?></td>
                <td><?= h($trabajadores->cedula) ?></td>
                <td><?= h($trabajadores->gerencia) ?></td>
                <td><?= h($trabajadores->cargo) ?></td>
                <td>
                    <?php if ($trabajadores->sede==0): ?>
                        <?= h('Sede del complejo Jose') ?>
                    <?php else: ?>
                        <?= h('Sede edificio Laguna') ?>
                    <?php endif; ?>
                </td>
                <td><?= h($trabajadores->numero_de_oficina) ?></td>
                <td><?= h($trabajadores->telefono_personal) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Trabajadores', 'action' => 'view', $trabajadores->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Trabajadores', 'action' => 'edit', $trabajadores->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Trabajadores', 'action' => 'delete', $trabajadores->id], ['confirm' => __('¿Confirma querer eliminar al trabajador {0}?', $trabajadores->titulo)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
</div>
