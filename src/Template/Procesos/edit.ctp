<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $proceso->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $proceso->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Procesos'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="procesos form large-9 medium-8 columns content">
    <?= $this->Form->create($proceso) ?>
    <fieldset>
        <legend><?= __('Edit Proceso') ?></legend>
        <?php
            echo $this->Form->input('Titulo');
            echo $this->Form->input('trabajor_id');
            echo $this->Form->input('Motivo');
            echo $this->Form->input('Tipo');
            echo $this->Form->input('Fecha_De_Solicitud');
            echo $this->Form->input('Fecha_De_Aprobacion', ['empty' => true]);
            echo $this->Form->input('Estado');
            echo $this->Form->input('Observaciones');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
