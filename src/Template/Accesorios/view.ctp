<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Accesorio'), ['action' => 'edit', $accesorio->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Accesorio'), ['action' => 'delete', $accesorio->id], ['confirm' => __('Are you sure you want to delete # {0}?', $accesorio->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Accesorios'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Accesorio'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Articulo'), ['controller' => 'Articulos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="accesorios view large-9 medium-8 columns content">
    <h3><?= h($accesorio->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Descripcion') ?></th>
            <td><?= h($accesorio->Descripcion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Articulo') ?></th>
            <td><?= $accesorio->has('articulo') ? $this->Html->link($accesorio->articulo->id, ['controller' => 'Articulos', 'action' => 'view', $accesorio->articulo->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($accesorio->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($accesorio->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($accesorio->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Estado') ?></h4>
        <?= $this->Text->autoParagraph(h($accesorio->Estado)); ?>
    </div>
</div>
