<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Contrato'), ['action' => 'edit', $contrato->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Contrato'), ['action' => 'delete', $contrato->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contrato->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Contratos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Contrato'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Trabajadores'), ['controller' => 'Trabajadores', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Trabajador'), ['controller' => 'Trabajadores', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="contratos view large-9 medium-8 columns content">
    <h3><?= h($contrato->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Titulo') ?></th>
            <td><?= h($contrato->Titulo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Trabajador') ?></th>
            <td><?= $contrato->has('trabajador') ? $this->Html->link($contrato->trabajador->id, ['controller' => 'Trabajadores', 'action' => 'view', $contrato->trabajador->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($contrato->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha De Inicio') ?></th>
            <td><?= h($contrato->Fecha_De_Inicio) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha De Culminacion') ?></th>
            <td><?= h($contrato->Fecha_De_Culminacion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($contrato->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($contrato->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Tipo De Contrato') ?></h4>
        <?= $this->Text->autoParagraph(h($contrato->Tipo_De_Contrato)); ?>
    </div>
</div>
