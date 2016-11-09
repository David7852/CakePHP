<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Nuevo Proceso'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Asignaciones'), ['controller' => 'Asignaciones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Formar Asignacion'), ['controller' => 'Asignaciones', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Devoluciones'), ['controller' => 'Devoluciones', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Formar Devolucion'), ['controller' => 'Devoluciones', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Trabajadores'), ['controller' => 'Trabajadores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nuevo Trabajador'), ['controller' => 'Trabajadores', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="procesos index large-9 medium-8 columns content">
    <h3><?= __('Procesos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('titulo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('motivo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fecha_de_solicitud') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fecha_de_aprobacion') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($procesos as $proceso): ?>
            <tr>
                <td><?= h($proceso->titulo) ?></td>
                <td><?= h($proceso->motivo) ?></td>
                <td><?= h($proceso->fecha_de_solicitud) ?></td>
                <td>
                    <?php if($proceso->fecha_de_aprobacion!=''):?>
                    <?= h($proceso->fecha_de_aprobacion) ?>
                    <?php else: ?>
                    <?= h('Sin aprobar') ?>
                    <?php endif; ?>
                </td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $proceso->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $proceso->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $proceso->id], ['confirm' => __('¿Confirma querer eliminar el proceso {0}?', $proceso->titulo)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('<')) ?>
            <?= str_replace("of","de",$this->Paginator->numbers()) ?>
            <?= $this->Paginator->next(__('>') . ' >') ?>
        </ul>
        <p><?= str_replace("of","de",$this->Paginator->counter()) ?></p>
    </div>
</div>
