<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Trabajador'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Contratos'), ['controller' => 'Contratos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Contrato'), ['controller' => 'Contratos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Procesos'), ['controller' => 'Procesos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Proceso'), ['controller' => 'Procesos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="trabajadores index large-9 medium-8 columns content">
    <h3><?= __('Trabajadores') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Nombre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Apellido') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Cedula') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Sede') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Numero_De_Oficina') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Telefono_Personal') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Rif') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Residencia') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($trabajadores as $trabajador): ?>
            <tr>
                <td><?= $this->Number->format($trabajador->id) ?></td>
                <td><?= h($trabajador->Nombre) ?></td>
                <td><?= h($trabajador->Apellido) ?></td>
                <td><?= h($trabajador->Cedula) ?></td>
                <td><?= $this->Number->format($trabajador->Sede) ?></td>
                <td><?= $this->Number->format($trabajador->Numero_De_Oficina) ?></td>
                <td><?= h($trabajador->Telefono_Personal) ?></td>
                <td><?= h($trabajador->Rif) ?></td>
                <td><?= h($trabajador->Residencia) ?></td>
                <td><?= h($trabajador->created) ?></td>
                <td><?= h($trabajador->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $trabajador->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $trabajador->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $trabajador->id], ['confirm' => __('Are you sure you want to delete # {0}?', $trabajador->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
