<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $linea->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $linea->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Lineas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Articulo'), ['controller' => 'Articulos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Rentas'), ['controller' => 'Rentas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Renta'), ['controller' => 'Rentas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="lineas form large-9 medium-8 columns content">
    <?= $this->Form->create($linea) ?>
    <fieldset>
        <legend><?= __('Edit Linea') ?></legend>
        <?php
            echo $this->Form->input('Operadora');
            echo $this->Form->input('Numero');
            echo $this->Form->input('Puk');
            echo $this->Form->input('Pin');
            echo $this->Form->input('Codigo_Sim');
            echo $this->Form->input('Articulo_id', ['options' => $articulos, 'empty' => true]);
            echo $this->Form->input('Estado');
            echo $this->Form->input('rentas._ids', ['options' => $rentas]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
