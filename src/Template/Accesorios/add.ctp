<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Accesorios'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Articulo'), ['controller' => 'Articulos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="accesorios form large-9 medium-8 columns content">
    <?= $this->Form->create($accesorio) ?>
    <fieldset>
        <legend><?= __('Add Accesorio') ?></legend>
        <?php
            echo $this->Form->input('descripcion');
            echo $this->Form->input('estado');
            echo $this->Form->input('articulo_id', ['options' => $articulos, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
