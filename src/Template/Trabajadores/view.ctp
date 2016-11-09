<?=$this->assign('title',"Trabajadores de Fertinitro")?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Editar a ').h($trabajador->name), ['action' => 'edit', $trabajador->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Eliminar a ').h($trabajador->name), ['action' => 'delete', $trabajador->id], ['confirm' => __('¿Confirma querer eliminar al trabajador {0}?', $trabajador->name)]) ?> </li>
        <li><?= $this->Html->link(__('Listar Trabajadores'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Trabajador'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Contratos'), ['controller' => 'Contratos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Contrato'), ['controller' => 'Contratos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Procesos'), ['controller' => 'Procesos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Proceso'), ['controller' => 'Procesos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="trabajadores view large-9 medium-8 columns content">
    <h3><?= h($trabajador->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($trabajador->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Apellido') ?></th>
            <td><?= h($trabajador->apellido) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cedula') ?></th>
            <td><?= h($trabajador->cedula) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Telefono Personal') ?></th>
            <td><?= h($trabajador->telefono_personal) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rif') ?></th>
            <td><?= h($trabajador->rif) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Residencia') ?></th>
            <td><?= h($trabajador->residencia) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Trabaja en la Sede') ?></th>
            <td>
                <?php if ($trabajador->sede==0): ?>
                <?= h('Sede del complejo Jose') ?>
                <?php else: ?>
                <?= h('Sede edificio Laguna') ?>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th scope="row"><?= __('Numero De Oficina') ?></th>
            <td><?= $this->Number->format($trabajador->numero_de_oficina) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sexo') ?></th>
            <td><?= h($trabajador->sexo) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Gerencia') ?></h4>
        <?= $this->Text->autoParagraph(h($trabajador->gerencia)); ?>
    </div>
    <div class="row">
        <h4><?= __('Cargo') ?></h4>
        <?= $this->Text->autoParagraph(h($trabajador->cargo)); ?>
    </div>
    
    <?php if (!empty($trabajador->contratos)): ?>
    <div class="related">
        <h4><?= __('Sus contratos:') ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Fecha De Inicio') ?></th>
                <th scope="col"><?= __('Fecha De Culminacion') ?></th>
                <th scope="col"><?= __('Tipo De Contrato') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($trabajador->contratos as $contratos): ?>
            <tr>
                <td><?= h($contratos->fecha_de_inicio) ?></td>
                <td><?= h($contratos->fecha_de_culminacion) ?></td>
                <td><?= h($contratos->tipo_de_contrato) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Contratos', 'action' => 'view', $contratos->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Contratos', 'action' => 'edit', $contratos->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Contratos', 'action' => 'delete', $contratos->id], ['confirm' => __('¿Confirma querer eliminar el contrato {0}?', $contratos->titulo)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>

    <?php if (!empty($trabajador->usuarios)): ?>
    <div class="related">
        <h4><?= __('Alias') ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Nombre De Usuario') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Funcion') ?></th>
                <th scope="col"><?= __('Imagen') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($trabajador->usuarios as $usuarios): ?>
            <tr>
                <td><?= h($usuarios->nombre_de_usuario) ?></td>
                <td><?= h($usuarios->email) ?></td>
                <td><?= h($usuarios->funcion) ?></td>
                <td><?= h($usuarios->imagen) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Usuarios', 'action' => 'view', $usuarios->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Usuarios', 'action' => 'edit', $usuarios->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Usuarios', 'action' => 'delete', $usuarios->id], ['confirm' => __('¿Confirma querer eliminar al usuario {0}?', $usuarios->nombre_de_usuario)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
    
    <?php if (!empty($trabajador->procesos)): ?>
    <div class="related">
        <h4><?= __('Procesos solicitados') ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Tipo') ?></th>
                <th scope="col"><?= __('Fecha De Solicitud') ?></th>
                <th scope="col"><?= __('Estado') ?></th>
                <th scope="col"><?= __('Observaciones') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($trabajador->procesos as $procesos): ?>
            <tr>
                <td><?= h($procesos->tipo) ?></td>
                <td><?= h($procesos->fecha_de_solicitud) ?></td>
                <td><?= h($procesos->estado) ?></td>
                <td><?= h($procesos->observaciones) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Procesos', 'action' => 'view', $procesos->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Procesos', 'action' => 'edit', $procesos->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Procesos', 'action' => 'delete', $procesos->id], ['confirm' => __('¿Confirma querer eliminar el proceso {0}?', $procesos->titulo)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
</div>
