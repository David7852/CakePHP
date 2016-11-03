<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $contrato->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $contrato->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Contratos'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="contratos form large-9 medium-8 columns content">
    <?= $this->Form->create($contrato) ?>
    <fieldset>
        <legend><?= __('Edit Contrato') ?></legend>
        <?php
            echo $this->Form->input('Titulo');
            echo $this->Form->input('trabajador_id');
            echo $this->Form->input('Fecha_De_Inicio');
            echo $this->Form->input('Fecha_De_Culminacion', ['empty' => true]);
            echo $this->Form->input('Tipo_De_Contrato');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
