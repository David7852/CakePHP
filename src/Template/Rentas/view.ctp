<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Renta'), ['action' => 'edit', $renta->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Renta'), ['action' => 'delete', $renta->id], ['confirm' => __('Are you sure you want to delete # {0}?', $renta->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Rentas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Renta'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Consumos'), ['controller' => 'Consumos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Consumo'), ['controller' => 'Consumos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Linea'), ['controller' => 'Lineas', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rentas view large-9 medium-8 columns content">
    <h3><?= h($renta->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($renta->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($renta->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Monto Basico') ?></th>
            <td><?= $this->Number->format($renta->monto_basico) ?></td>
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
    <div class="row">
        <h4><?= __('Operadora') ?></h4>
        <?= $this->Text->autoParagraph(h($renta->operadora)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Consumos') ?></h4>
        <?php if (!empty($renta->consumos)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Titulo') ?></th>
                <th scope="col"><?= __('Factura Id') ?></th>
                <th scope="col"><?= __('Renta Id') ?></th>
                <th scope="col"><?= __('Consumido') ?></th>
                <th scope="col"><?= __('Excedente') ?></th>
                <th scope="col"><?= __('Monto Bs') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($renta->consumos as $consumos): ?>
            <tr>
                <td><?= h($consumos->id) ?></td>
                <td><?= h($consumos->titulo) ?></td>
                <td><?= h($consumos->factura_id) ?></td>
                <td><?= h($consumos->renta_id) ?></td>
                <td><?= h($consumos->consumido) ?></td>
                <td><?= h($consumos->excedente) ?></td>
                <td><?= h($consumos->monto_bs) ?></td>
                <td><?= h($consumos->created) ?></td>
                <td><?= h($consumos->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Consumos', 'action' => 'view', $consumos->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Consumos', 'action' => 'edit', $consumos->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Consumos', 'action' => 'delete', $consumos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $consumos->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
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
                <th scope="col"><?= __('Observaciones') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($renta->lineas as $lineas): ?>
            <tr>
                <td><?= h($lineas->id) ?></td>
                <td><?= h($lineas->operadora) ?></td>
                <td><?= h($lineas->numero) ?></td>
                <td><?= h($lineas->puk) ?></td>
                <td><?= h($lineas->pin) ?></td>
                <td><?= h($lineas->codigo_sim) ?></td>
                <td><?= h($lineas->articulo_id) ?></td>
                <td><?= h($lineas->estado) ?></td>
                <td><?= h($lineas->observaciones) ?></td>
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
