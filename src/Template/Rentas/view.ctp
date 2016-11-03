<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Renta'), ['action' => 'edit', $renta->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Renta'), ['action' => 'delete', $renta->id], ['confirm' => __('Are you sure you want to delete # {0}?', $renta->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Rentas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Renta'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Linea'), ['controller' => 'Lineas', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rentas view large-9 medium-8 columns content">
    <h3><?= h($renta->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($renta->Nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($renta->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Monto Basico') ?></th>
            <td><?= $this->Number->format($renta->Monto_Basico) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($renta->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($renta->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Lineas') ?></h4>
        <?php if (!empty($renta->lineas)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Operadora') ?></th>
                <th scope="col"><?= __('Numero') ?></th>
                <th scope="col"><?= __('Puk') ?></th>
                <th scope="col"><?= __('Pin') ?></th>
                <th scope="col"><?= __('Codigo Sim') ?></th>
                <th scope="col"><?= __('Articulo Id') ?></th>
                <th scope="col"><?= __('Estado') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($renta->lineas as $lineas): ?>
            <tr>
                <td><?= h($lineas->id) ?></td>
                <td><?= h($lineas->Operadora) ?></td>
                <td><?= h($lineas->Numero) ?></td>
                <td><?= h($lineas->Puk) ?></td>
                <td><?= h($lineas->Pin) ?></td>
                <td><?= h($lineas->Codigo_Sim) ?></td>
                <td><?= h($lineas->Articulo_id) ?></td>
                <td><?= h($lineas->Estado) ?></td>
                <td><?= h($lineas->created) ?></td>
                <td><?= h($lineas->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Lineas', 'action' => 'view', $lineas->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Lineas', 'action' => 'edit', $lineas->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Lineas', 'action' => 'delete', $lineas->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lineas->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
