<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Edit Lineas Renta'), ['action' => 'edit', $lineasRenta->linea_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Lineas Renta'), ['action' => 'delete', $lineasRenta->linea_id], ['confirm' => __('Are you sure you want to delete # {0}?', $lineasRenta->linea_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Lineas Rentas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lineas Renta'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Linea'), ['controller' => 'Lineas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Rentas'), ['controller' => 'Rentas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Renta'), ['controller' => 'Rentas', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="lineasRentas view large-9 medium-8 columns content">
    <h3><?= h($lineasRenta->linea_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Linea') ?></th>
            <td><?= $lineasRenta->has('linea') ? $this->Html->link($lineasRenta->linea->numero, ['controller' => 'Lineas', 'action' => 'view', $lineasRenta->linea->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Renta') ?></th>
            <td><?= $lineasRenta->has('renta') ? $this->Html->link($lineasRenta->renta->nombre, ['controller' => 'Rentas', 'action' => 'view', $lineasRenta->renta->id]) : '' ?></td>
        </tr>
    </table>
</div>
