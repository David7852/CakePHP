<?=$this->assign('title',"Modelos y Marcas")?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Agregar Modelo'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Agregar Articulo'), ['controller' => 'Articulos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="modelos index large-9 medium-8 columns content">
    <h3><?= __('Modelos registrados') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('marca') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modelo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tipo_de_articulo') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($modelos as $modelo): ?>
            <tr>
                <td><?= h($modelo->marca) ?></td>
                <td><?= h($modelo->modelo) ?></td>
                <td><?= h($modelo->tipo_de_articulo) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $modelo->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $modelo->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $modelo->id], ['confirm' => __('¿Confirma querer eliminar el tipo de {0}?', $modelo->name)]) ?>
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
