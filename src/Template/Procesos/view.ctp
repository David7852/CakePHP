<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Proceso'), ['action' => 'edit', $proceso->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Proceso'), ['action' => 'delete', $proceso->id], ['confirm' => __('Are you sure you want to delete # {0}?', $proceso->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Procesos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Proceso'), ['action' => 'add']) ?> </li>
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
            <th scope="row"><?= __('Trabajador Id') ?></th>
            <td><?= $this->Number->format($proceso->trabajador_id) ?></td>
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
</div>
