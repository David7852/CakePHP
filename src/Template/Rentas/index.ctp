<?=$this->assign('title',"Rentas y Planes")?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Nueva Renta'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Servicios'), ['controller' => 'Servicios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nuevo Servicio'), ['controller' => 'Servicios', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nueva Linea'), ['controller' => 'Lineas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rentas index large-9 medium-8 columns content">
    <h3><?= __('Rentas Disponibles') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('nombre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('monto_basico') ?></th>
                <th scope="col"><?= $this->Paginator->sort('operadora') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rentas as $renta): ?>
            <tr>
                <td><?= h($renta->nombre) ?></td>
                <td><?= $this->Number->format($renta->monto_basico)." Bs" ?></td>
                <td><?=$this->Text->autoParagraph(h($renta->operadora))?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $renta->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $renta->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $renta->id], ['confirm' => __('¿Confirma querer eliminar la renta o plan {0}?', $renta->nombre)]) ?>
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
