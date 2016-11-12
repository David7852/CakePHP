<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $lineasRenta->linea_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $lineasRenta->linea_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Lineas Rentas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Linea'), ['controller' => 'Lineas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Rentas'), ['controller' => 'Rentas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Renta'), ['controller' => 'Rentas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="lineasRentas form large-9 medium-8 columns content">
    <?= $this->Form->create($lineasRenta) ?>
    <fieldset>
        <legend><?= __('Edit Lineas Renta') ?></legend>
        <?php
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
