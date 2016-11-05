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
                <th scope="col"><?= $this->Paginator->sort('nombre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('apellido') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cedula') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sede') ?></th>
                <th scope="col"><?= $this->Paginator->sort('numero_de_oficina') ?></th>
                <th scope="col"><?= $this->Paginator->sort('telefono_personal') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rif') ?></th>
                <th scope="col"><?= $this->Paginator->sort('residencia') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($trabajadores as $trabajador): ?>
            <tr>
                <td><?= $this->Number->format($trabajador->id) ?></td>
                <td><?= h($trabajador->nombre) ?></td>
                <td><?= h($trabajador->apellido) ?></td>
                <td><?= h($trabajador->cedula) ?></td>
                <td><?= $this->Number->format($trabajador->sede) ?></td>
                <td><?= $this->Number->format($trabajador->numero_de_oficina) ?></td>
                <td><?= h($trabajador->telefono_personal) ?></td>
                <td><?= h($trabajador->rif) ?></td>
                <td><?= h($trabajador->residencia) ?></td>
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
