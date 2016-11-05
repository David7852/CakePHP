<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Proceso'), ['action' => 'edit', $proceso->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Proceso'), ['action' => 'delete', $proceso->id], ['confirm' => __('Are you sure you want to delete # {0}?', $proceso->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Procesos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Proceso'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Trabajadores'), ['controller' => 'Trabajadores', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Trabajador'), ['controller' => 'Trabajadores', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="procesos view large-9 medium-8 columns content">
    <h3><?= h($proceso->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Titulo') ?></th>
            <td><?= h($proceso->Titulo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Motivo') ?></th>
            <td><?= h($proceso->Motivo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($proceso->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha De Solicitud') ?></th>
            <td><?= h($proceso->Fecha_De_Solicitud) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha De Aprobacion') ?></th>
            <td><?= h($proceso->Fecha_De_Aprobacion) ?></td>
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
        <?= $this->Text->autoParagraph(h($proceso->Tipo)); ?>
    </div>
    <div class="row">
        <h4><?= __('Estado') ?></h4>
        <?= $this->Text->autoParagraph(h($proceso->Estado)); ?>
    </div>
    <div class="row">
        <h4><?= __('Observaciones') ?></h4>
        <?= $this->Text->autoParagraph(h($proceso->Observaciones)); ?>
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
                <td><?= h($trabajadores->Nombre) ?></td>
                <td><?= h($trabajadores->Apellido) ?></td>
                <td><?= h($trabajadores->Cedula) ?></td>
                <td><?= h($trabajadores->Gerencia) ?></td>
                <td><?= h($trabajadores->Cargo) ?></td>
                <td><?= h($trabajadores->Sede) ?></td>
                <td><?= h($trabajadores->Numero_De_Oficina) ?></td>
                <td><?= h($trabajadores->Telefono_Personal) ?></td>
                <td><?= h($trabajadores->Rif) ?></td>
                <td><?= h($trabajadores->Residencia) ?></td>
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
