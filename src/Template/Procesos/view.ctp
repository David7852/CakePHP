<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Proceso'), ['action' => 'edit', $proceso->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Proceso'), ['action' => 'delete', $proceso->id], ['confirm' => __('Are you sure you want to delete # {0}?', $proceso->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Procesos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Proceso'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Asignaciones'), ['controller' => 'Asignaciones', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asignacion'), ['controller' => 'Asignaciones', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Devoluciones'), ['controller' => 'Devoluciones', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Devolucion'), ['controller' => 'Devoluciones', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Trabajadores'), ['controller' => 'Trabajadores', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Trabajador'), ['controller' => 'Trabajadores', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="procesos view large-9 medium-8 columns content">
    <h3><?= h($proceso->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Titulo') ?></th>
            <td><?= h($proceso->titulo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Motivo') ?></th>
            <td><?= h($proceso->motivo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($proceso->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha De Solicitud') ?></th>
            <td><?= h($proceso->fecha_de_solicitud) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha De Aprobacion') ?></th>
            <td><?= h($proceso->fecha_de_aprobacion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($proceso->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($proceso->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Tipo') ?></h4>
        <?= $this->Text->autoParagraph(h($proceso->tipo)); ?>
    </div>
    <div class="row">
        <h4><?= __('Estado') ?></h4>
        <?= $this->Text->autoParagraph(h($proceso->estado)); ?>
    </div>
    <div class="row">
        <h4><?= __('Observaciones') ?></h4>
        <?= $this->Text->autoParagraph(h($proceso->observaciones)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Asignaciones') ?></h4>
        <?php if (!empty($proceso->asignaciones)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Titulo') ?></th>
                <th scope="col"><?= __('Proceso Id') ?></th>
                <th scope="col"><?= __('Articulo Id') ?></th>
                <th scope="col"><?= __('Hasta') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($proceso->asignaciones as $asignaciones): ?>
            <tr>
                <td><?= h($asignaciones->id) ?></td>
                <td><?= h($asignaciones->titulo) ?></td>
                <td><?= h($asignaciones->proceso_id) ?></td>
                <td><?= h($asignaciones->articulo_id) ?></td>
                <td><?= h($asignaciones->hasta) ?></td>
                <td><?= h($asignaciones->created) ?></td>
                <td><?= h($asignaciones->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Asignaciones', 'action' => 'view', $asignaciones->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Asignaciones', 'action' => 'edit', $asignaciones->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Asignaciones', 'action' => 'delete', $asignaciones->id], ['confirm' => __('Are you sure you want to delete # {0}?', $asignaciones->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Devoluciones') ?></h4>
        <?php if (!empty($proceso->devoluciones)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Titulo') ?></th>
                <th scope="col"><?= __('Proceso Id') ?></th>
                <th scope="col"><?= __('Articulo Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($proceso->devoluciones as $devoluciones): ?>
            <tr>
                <td><?= h($devoluciones->id) ?></td>
                <td><?= h($devoluciones->titulo) ?></td>
                <td><?= h($devoluciones->proceso_id) ?></td>
                <td><?= h($devoluciones->articulo_id) ?></td>
                <td><?= h($devoluciones->created) ?></td>
                <td><?= h($devoluciones->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Devoluciones', 'action' => 'view', $devoluciones->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Devoluciones', 'action' => 'edit', $devoluciones->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Devoluciones', 'action' => 'delete', $devoluciones->id], ['confirm' => __('Are you sure you want to delete # {0}?', $devoluciones->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Trabajadores') ?></h4>
        <?php if (!empty($proceso->trabajadores)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Nombre') ?></th>
                <th scope="col"><?= __('Apellido') ?></th>
                <th scope="col"><?= __('Cedula') ?></th>
                <th scope="col"><?= __('Sexo') ?></th>
                <th scope="col"><?= __('Gerencia') ?></th>
                <th scope="col"><?= __('Cargo') ?></th>
                <th scope="col"><?= __('Sede') ?></th>
                <th scope="col"><?= __('Numero De Oficina') ?></th>
                <th scope="col"><?= __('Telefono Personal') ?></th>
                <th scope="col"><?= __('Rif') ?></th>
                <th scope="col"><?= __('Residencia') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($proceso->trabajadores as $trabajadores): ?>
            <tr>
                <td><?= h($trabajadores->id) ?></td>
                <td><?= h($trabajadores->nombre) ?></td>
                <td><?= h($trabajadores->apellido) ?></td>
                <td><?= h($trabajadores->cedula) ?></td>
                <td><?= h($trabajadores->sexo) ?></td>
                <td><?= h($trabajadores->gerencia) ?></td>
                <td><?= h($trabajadores->cargo) ?></td>
                <td><?= h($trabajadores->sede) ?></td>
                <td><?= h($trabajadores->numero_de_oficina) ?></td>
                <td><?= h($trabajadores->telefono_personal) ?></td>
                <td><?= h($trabajadores->rif) ?></td>
                <td><?= h($trabajadores->residencia) ?></td>
                <td><?= h($trabajadores->created) ?></td>
                <td><?= h($trabajadores->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Trabajadores', 'action' => 'view', $trabajadores->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Trabajadores', 'action' => 'edit', $trabajadores->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Trabajadores', 'action' => 'delete', $trabajadores->id], ['confirm' => __('Are you sure you want to delete # {0}?', $trabajadores->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
