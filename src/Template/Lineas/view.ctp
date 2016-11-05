<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Linea'), ['action' => 'edit', $linea->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Linea'), ['action' => 'delete', $linea->id], ['confirm' => __('Are you sure you want to delete # {0}?', $linea->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Lineas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Linea'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Articulo'), ['controller' => 'Articulos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Facturas'), ['controller' => 'Facturas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Factura'), ['controller' => 'Facturas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Rentas'), ['controller' => 'Rentas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Renta'), ['controller' => 'Rentas', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="lineas view large-9 medium-8 columns content">
    <h3><?= h($linea->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Numero') ?></th>
            <td><?= h($linea->numero) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Codigo Sim') ?></th>
            <td><?= h($linea->codigo_sim) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Articulo') ?></th>
            <td><?= $linea->has('articulo') ? $this->Html->link($linea->articulo->id, ['controller' => 'Articulos', 'action' => 'view', $linea->articulo->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Observaciones') ?></th>
            <td><?= h($linea->observaciones) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($linea->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Puk') ?></th>
            <td><?= $this->Number->format($linea->puk) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pin') ?></th>
            <td><?= $this->Number->format($linea->pin) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($linea->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($linea->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Operadora') ?></h4>
        <?= $this->Text->autoParagraph(h($linea->operadora)); ?>
    </div>
    <div class="row">
        <h4><?= __('Estado') ?></h4>
        <?= $this->Text->autoParagraph(h($linea->estado)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Facturas') ?></h4>
        <?php if (!empty($linea->facturas)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Titulo') ?></th>
                <th scope="col"><?= __('Linea Id') ?></th>
                <th scope="col"><?= __('Paguese Antes De') ?></th>
                <th scope="col"><?= __('Balance') ?></th>
                <th scope="col"><?= __('Desde') ?></th>
                <th scope="col"><?= __('Hasta') ?></th>
                <th scope="col"><?= __('Numero De Cuenta') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($linea->facturas as $facturas): ?>
            <tr>
                <td><?= h($facturas->id) ?></td>
                <td><?= h($facturas->titulo) ?></td>
                <td><?= h($facturas->linea_id) ?></td>
                <td><?= h($facturas->paguese_antes_de) ?></td>
                <td><?= h($facturas->balance) ?></td>
                <td><?= h($facturas->desde) ?></td>
                <td><?= h($facturas->hasta) ?></td>
                <td><?= h($facturas->numero_de_cuenta) ?></td>
                <td><?= h($facturas->created) ?></td>
                <td><?= h($facturas->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Facturas', 'action' => 'view', $facturas->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Facturas', 'action' => 'edit', $facturas->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Facturas', 'action' => 'delete', $facturas->id], ['confirm' => __('Are you sure you want to delete # {0}?', $facturas->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Rentas') ?></h4>
        <?php if (!empty($linea->rentas)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Nombre') ?></th>
                <th scope="col"><?= __('Monto Basico') ?></th>
                <th scope="col"><?= __('Operadora') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($linea->rentas as $rentas): ?>
            <tr>
                <td><?= h($rentas->id) ?></td>
                <td><?= h($rentas->nombre) ?></td>
                <td><?= h($rentas->monto_basico) ?></td>
                <td><?= h($rentas->operadora) ?></td>
                <td><?= h($rentas->created) ?></td>
                <td><?= h($rentas->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Rentas', 'action' => 'view', $rentas->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Rentas', 'action' => 'edit', $rentas->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Rentas', 'action' => 'delete', $rentas->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rentas->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
