<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Trabajador'), ['action' => 'edit', $trabajador->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Trabajador'), ['action' => 'delete', $trabajador->id], ['confirm' => __('Are you sure you want to delete # {0}?', $trabajador->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Trabajadores'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Trabajador'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Contratos'), ['controller' => 'Contratos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Contrato'), ['controller' => 'Contratos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Procesos'), ['controller' => 'Procesos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Proceso'), ['controller' => 'Procesos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="trabajadores view large-9 medium-8 columns content">
    <h3><?= h($trabajador->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($trabajador->Nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Apellido') ?></th>
            <td><?= h($trabajador->Apellido) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cedula') ?></th>
            <td><?= h($trabajador->Cedula) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Telefono Personal') ?></th>
            <td><?= h($trabajador->Telefono_Personal) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rif') ?></th>
            <td><?= h($trabajador->Rif) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Residencia') ?></th>
            <td><?= h($trabajador->Residencia) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($trabajador->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sede') ?></th>
            <td><?= $this->Number->format($trabajador->Sede) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Numero De Oficina') ?></th>
            <td><?= $this->Number->format($trabajador->Numero_De_Oficina) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($trabajador->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($trabajador->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Gerencia') ?></h4>
        <?= $this->Text->autoParagraph(h($trabajador->Gerencia)); ?>
    </div>
    <div class="row">
        <h4><?= __('Cargo') ?></h4>
        <?= $this->Text->autoParagraph(h($trabajador->Cargo)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Contratos') ?></h4>
        <?php if (!empty($trabajador->contratos)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Titulo') ?></th>
                <th scope="col"><?= __('Trabajador Id') ?></th>
                <th scope="col"><?= __('Fecha De Inicio') ?></th>
                <th scope="col"><?= __('Fecha De Culminacion') ?></th>
                <th scope="col"><?= __('Tipo De Contrato') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($trabajador->contratos as $contratos): ?>
            <tr>
                <td><?= h($contratos->id) ?></td>
                <td><?= h($contratos->Titulo) ?></td>
                <td><?= h($contratos->trabajador_id) ?></td>
                <td><?= h($contratos->Fecha_De_Inicio) ?></td>
                <td><?= h($contratos->Fecha_De_Culminacion) ?></td>
                <td><?= h($contratos->Tipo_De_Contrato) ?></td>
                <td><?= h($contratos->created) ?></td>
                <td><?= h($contratos->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Contratos', 'action' => 'view', $contratos->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Contratos', 'action' => 'edit', $contratos->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Contratos', 'action' => 'delete', $contratos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contratos->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Usuarios') ?></h4>
        <?php if (!empty($trabajador->usuarios)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Nombre De Usuario') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Clave') ?></th>
                <th scope="col"><?= __('Funcion') ?></th>
                <th scope="col"><?= __('Trabajador Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($trabajador->usuarios as $usuarios): ?>
            <tr>
                <td><?= h($usuarios->id) ?></td>
                <td><?= h($usuarios->Nombre_De_Usuario) ?></td>
                <td><?= h($usuarios->Email) ?></td>
                <td><?= h($usuarios->Clave) ?></td>
                <td><?= h($usuarios->Funcion) ?></td>
                <td><?= h($usuarios->trabajador_id) ?></td>
                <td><?= h($usuarios->created) ?></td>
                <td><?= h($usuarios->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Usuarios', 'action' => 'view', $usuarios->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Usuarios', 'action' => 'edit', $usuarios->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Usuarios', 'action' => 'delete', $usuarios->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usuarios->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Procesos') ?></h4>
        <?php if (!empty($trabajador->procesos)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Titulo') ?></th>
                <th scope="col"><?= __('Trabajador Id') ?></th>
                <th scope="col"><?= __('Motivo') ?></th>
                <th scope="col"><?= __('Tipo') ?></th>
                <th scope="col"><?= __('Fecha De Solicitud') ?></th>
                <th scope="col"><?= __('Fecha De Aprobacion') ?></th>
                <th scope="col"><?= __('Estado') ?></th>
                <th scope="col"><?= __('Observaciones') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($trabajador->procesos as $procesos): ?>
            <tr>
                <td><?= h($procesos->id) ?></td>
                <td><?= h($procesos->Titulo) ?></td>
                <td><?= h($procesos->trabajador_id) ?></td>
                <td><?= h($procesos->Motivo) ?></td>
                <td><?= h($procesos->Tipo) ?></td>
                <td><?= h($procesos->Fecha_De_Solicitud) ?></td>
                <td><?= h($procesos->Fecha_De_Aprobacion) ?></td>
                <td><?= h($procesos->Estado) ?></td>
                <td><?= h($procesos->Observaciones) ?></td>
                <td><?= h($procesos->created) ?></td>
                <td><?= h($procesos->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Procesos', 'action' => 'view', $procesos->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Procesos', 'action' => 'edit', $procesos->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Procesos', 'action' => 'delete', $procesos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $procesos->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
