<?=$this->assign('title',"Trabajadores de Fertinitro")?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Nuevo Trabajador'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Contratos'), ['controller' => 'Contratos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nuevo Contrato'), ['controller' => 'Contratos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nuevo Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Procesos'), ['controller' => 'Procesos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nuevo Proceso'), ['controller' => 'Procesos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="trabajadores index large-9 medium-8 columns content">
    <h3><?= __('Trabajadores') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('nombre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('apellido') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cedula') ?></th>
                <th scope="col"><?= $this->Paginator->sort('gerencia') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cargo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sede') ?></th>                
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($trabajadores as $trabajador): ?>
            <tr>
                <td><?= h($trabajador->nombre) ?></td>
                <td><?= h($trabajador->apellido) ?></td>
                <td><?= h($trabajador->cedula) ?></td>                
                <td><?=$this->Text->autoParagraph(h($trabajador->gerencia))?></td>
                <td><?=$this->Text->autoParagraph(h($trabajador->cargo))?></td>
                <td>
                <?php if ($trabajador->sede==0): ?>
                <?= h('Sede del complejo Jose') ?>
                <?php else: ?>
                <?= h('Sede edificio Laguna') ?>
                <?php endif; ?>
                </td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $trabajador->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $trabajador->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $trabajador->id], ['confirm' => __('¿Confirma querer eliminar al trabajador {0}?', $trabajador->titulo)]) ?>
                </td>
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
