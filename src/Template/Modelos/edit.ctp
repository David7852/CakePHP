<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $modelo->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $modelo->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Modelos'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="modelos form large-9 medium-8 columns content">
    <?= $this->Form->create($modelo) ?>
    <fieldset>
        <legend><?= __('Edit Modelo') ?></legend>
        <?php
            echo $this->Form->input('Marca');
            echo $this->Form->input('Modelo');
            echo $this->Form->input('Tipo_De_Articulo');
            echo $this->Form->input('Serial_Comun');
            echo $this->Form->input('Imagen');
            echo $this->Form->input('Abstracto');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
