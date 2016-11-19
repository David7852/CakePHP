<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Editar esta Linea'), ['action' => 'edit', $linea->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Eliminar esta Linea'), ['action' => 'delete', $linea->id], ['confirm' => __('¿Confirma querer eliminar la linea {0}?', $linea->numero)]) ?> </li>
        <li><?= $this->Html->link(__('Listar Lineas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nueva Linea'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nueva Articulo'), ['controller' => 'Articulos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Facturas'), ['controller' => 'Facturas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nueva Factura'), ['controller' => 'Facturas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Rentas'), ['controller' => 'Rentas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nueva Renta'), ['controller' => 'Rentas', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="lineas view large-9 medium-8 columns content">
    <h3><?= 'Linea '.h($linea->numero)//en lugar de numero, el nombre del propietario del equipo debería ir aca, si y
        // solo si la linea esta asignada a alguien. de lo contrario, mostrar numero ?></h3>
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
            <td><?= $linea->has('articulo') ? $this->Html->link($linea->articulo->titulo, ['controller' => 'Articulos', 'action' => 'view', $linea->articulo->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Observaciones') ?></th>
            <td><?= h($linea->observaciones) ?></td>
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
            <th scope="row"><?= __('Operadora') ?></th>
            <td><?= h($this->operadora) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estado') ?></th>
            <td><?= h($this->estado) ?></td>
        </tr>
    </table>
    <?php if (!empty($linea->facturas)): ?>
    <div class="related">
        <h4><?= __('Facturas de esta linea') ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Titulo') ?></th>
                <th scope="col"><?= __('Paguese Antes De') ?></th>
                <th scope="col"><?= __('Balance') ?></th>
                <th scope="col"><?= __('Desde') ?></th>
                <th scope="col"><?= __('Hasta') ?></th>
                <th scope="col"><?= __('Numero De Cuenta') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($linea->facturas as $facturas): ?>
            <tr>
                <td><?= h($facturas->titulo) ?></td>
                <td><?= h($facturas->paguese_antes_de) ?></td>
                <td><?= h($facturas->balance) ?></td>
                <td><?= h($facturas->desde) ?></td>
                <td><?= h($facturas->hasta) ?></td>
                <td><?= h($facturas->numero_de_cuenta) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Facturas', 'action' => 'view', $facturas->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Facturas', 'action' => 'edit', $facturas->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Facturas', 'action' => 'delete', $facturas->id], ['confirm' => __('Confirma querer eliminar la factura {0}?', $facturas->titulo)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
    <?php if (!empty($linea->rentas)): ?>
    <div class="related">
        <h4><?= __('Rentas y planes asignados') ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Nombre') ?></th>
                <th scope="col"><?= __('Monto Basico') ?></th>
                <th scope="col"><?= __('Operadora') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($linea->rentas as $rentas): ?>
            <tr>
                <td><?= h($rentas->nombre) ?></td>
                <td><?= h($rentas->monto_basico) ?></td>
                <td><?= h($rentas->operadora) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Rentas', 'action' => 'view', $rentas->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Rentas', 'action' => 'edit', $rentas->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Rentas', 'action' => 'delete', $rentas->id], ['confirm' => __('¿Confirma querer eliminar la renta o plan {0}?', $rentas->nombre)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
</div>
