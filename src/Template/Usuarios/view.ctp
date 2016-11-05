<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Usuario'), ['action' => 'edit', $usuario->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Usuario'), ['action' => 'delete', $usuario->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usuario->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Usuarios'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Usuario'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Trabajadores'), ['controller' => 'Trabajadores', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Trabajador'), ['controller' => 'Trabajadores', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="usuarios view large-9 medium-8 columns content">
    <h3><?= h($usuario->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre De Usuario') ?></th>
            <td><?= h($usuario->Nombre_De_Usuario) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($usuario->Email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Clave') ?></th>
            <td><?= h($usuario->Clave) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Trabajador') ?></th>
            <td><?= $usuario->has('trabajador') ? $this->Html->link($usuario->trabajador->id, ['controller' => 'Trabajadores', 'action' => 'view', $usuario->trabajador->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($usuario->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($usuario->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($usuario->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Funcion') ?></h4>
        <?= $this->Text->autoParagraph(h($usuario->Funcion)); ?>
    </div>
    <div class="row">
        <h4><?= __('Imagen') ?></h4>
        <?= $this->Text->autoParagraph(h($usuario->Imagen)); ?>
    </div>
</div>
