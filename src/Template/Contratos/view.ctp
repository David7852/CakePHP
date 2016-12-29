<?=$this->assign('title',"Contratos de los trabajadores")?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Editar este Contrato'), ['action' => 'edit', $contrato->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Eliminar este Contrato'), ['action' => 'delete', $contrato->id], ['confirm' => __('¿Confirma querer eliminar el contrato {0}?', $contrato->titulo)]) ?> </li>
        <li><?= $this->Html->link(__('Listar Contratos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Contrato'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Trabajadores'), ['controller' => 'Trabajadores', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Trabajador'), ['controller' => 'Trabajadores', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="contratos view large-9 medium-8 columns content">
    <h3><?= 'Contraro de '.h($contrato->titulo) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Trabajador') ?></th>
            <td><?= $contrato->has('trabajador') ? $this->Html->link($contrato->trabajador->titulo, ['controller' => 'Trabajadores', 'action' => 'view', $contrato->trabajador->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha De Inicio') ?></th>
            <td><?= h($contrato->fecha_de_inicio) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha De Culminacion') ?></th>
            <td><?= h($contrato->fecha_de_culminacion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo De Contrato') ?></th>
            <td><?= h($contrato->tipo_de_contrato) ?></td>
        </tr>
    </table>
</div>
