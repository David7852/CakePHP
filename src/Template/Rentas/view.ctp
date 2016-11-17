<?=$this->assign('title',"Rentas y Planes")?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Editar ').h($renta->nombre), ['action' => 'edit', $renta->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Eliminar ').h($renta->nombre), ['action' => 'delete', $renta->id], ['confirm' => __('¿Confirma querer eliminar la renta {0}?', $renta->nombre)]) ?> </li>
        <li><?= $this->Html->link(__('Listar Rentas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nueva Renta'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Servicios'), ['controller' => 'Servicios', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Servicio'), ['controller' => 'Servicios', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Listar Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nueva Linea'), ['controller' => 'Lineas', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rentas view large-9 medium-8 columns content">
    <h3><?= h($renta->nombre) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Monto Basico') ?></th>
            <td><?= $this->Number->format($renta->monto_basico)." Bs" ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Operadora') ?></th>
            <td><?= $this->Text->autoParagraph(h($renta->operadora)) ?></td>
        </tr>
    </table>
    <?php if (!empty($renta->servicios)): ?>
    <div class="related">
        <h4><?= __('Consumos realizados') ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Nombre') ?></th>
                <th scope="col"><?= __('Cupo') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($renta->servicios as $servicios): ?>
            <tr>
                <td><?= h($servicios->nombre) ?></td>
                <td><?= h($servicios->cupo) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Consumos', 'action' => 'view', $servicios->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Consumos', 'action' => 'edit', $servicios->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Consumos', 'action' => 'delete', $servicios->id], ['confirm' => __('¿Confirma querer eliminar el consumo {0}?', $servicios->titulo)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
    <?php if (!empty($renta->lineas)): ?>
    <div class="related">
        <h4><?= __('Lineas con ').h($renta->nombre) ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Numero') ?></th>
                <th scope="col"><?= __('Puk') ?></th>
                <th scope="col"><?= __('Pin') ?></th>
                <th scope="col"><?= __('Codigo Sim') ?></th>
                <th scope="col"><?= __('Articulo Id') ?></th>
                <th scope="col"><?= __('Estado') ?></th>
                <th scope="col"><?= __('Observaciones') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($renta->lineas as $lineas): ?>
            <tr>
                <td><?= h($lineas->numero) ?></td>
                <td><?= h($lineas->puk) ?></td>
                <td><?= h($lineas->pin) ?></td>
                <td><?= h($lineas->codigo_sim) ?></td>
                <td><?= h($lineas->articulo_id) ?></td>
                <td><?= h($lineas->estado) ?></td>
                <td><?= h($lineas->observaciones) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Lineas', 'action' => 'view', $lineas->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Lineas', 'action' => 'edit', $lineas->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Lineas', 'action' => 'delete', $lineas->id], ['confirm' => __('¿Confirma querer eliminar la linea {0}?', $lineas->numero)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
</div>
