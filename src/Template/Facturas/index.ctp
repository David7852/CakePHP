<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="tlf" id="seleccion"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <!-- $ -->
        <?php if($b===null): ?>
        <li><?= $this->Html->link(__('Agregar Factura'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Agregar Lineas'), ['controller' => 'Lineas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Consumos'), ['controller' => 'Consumos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Agregar Consumo'), ['controller' => 'Consumos', 'action' => 'add'], ['class'=>'viewLink']) ?></li>
        <?php else: ?>
        <li><?= $this->Html->link(__('Reporte'), ['action' => 'facturacion',date("Y-m").'-1'],['style'=>'color:#D7782E']); ?></li>
        <li><?= $this->Form->postLink(__('Aprobar'), ['controller' => 'Facturas','action' => 'aprobar',date("Y-m").'-1'],['style'=>'color:#C3232D','confirm' => __('¿Aprueba que los balances de las facturas sean escritos permanentemente en la base de datos?')]); ?></li>
        <?php endif; ?>
        <!-- $ -->
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="usu" ><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
    </ul>
</nav>
<div class="facturas index large-9 medium-8 columns content">
    <?php setlocale(LC_ALL,"es_ES@euro","es_ES","esp"); ?>
    <h3><?= $b===null ? 'Facturas' : 'Facturas del mes de '.strftime("%B"); ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('linea_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('balance') ?></th>
                <th scope="col"><?= $this->Paginator->sort('iva') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cargos_extra') ?></th>
                <th scope="col"><?= $this->Paginator->sort('desde') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hasta') ?></th>
                <th scope="col"><?= $this->Paginator->sort('paguese_antes_de') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($facturas as $factura): ?>
            <tr>
                <td><?= $factura->has('linea') ? $this->Html->link($factura->linea->numero, ['controller' => 'Lineas', 'action' => 'view', $factura->linea->id]) : '' ?></td>
                <td><?= $this->Number->format($factura->balance).' Bs' ?></td>
                <td><?= $this->Number->format($factura->iva).' Bs' ?></td>
                <td><?= $this->Number->format($factura->cargos_extra).' Bs' ?></td>
                <td><?= h($factura->desde) ?></td>
                <td><?= h($factura->hasta) ?></td>
                <td><?= h($factura->paguese_antes_de) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $factura->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $factura->id]) ?>
                <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?><!-->
                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $factura->id], ['confirm' => __('¿Confirma querer eliminar la factura del {0}?', $factura->title)]) ?>
                <?php endif; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('<')) ?>
            <?= str_replace("of","de",$this->Paginator->numbers()) ." ". str_replace("of","de",$this->Paginator->counter()) ?>
            <?= $this->Paginator->next(__('>') . ' >') ?>
        </ul>

    </div>
    <?php if($b!==null): ?>
        <h4>En el mes de <?= strftime("%B del %Y"); ?>, el monto a cancelar es de: <?= $b; ?>Bs.</h4>
    <?php endif; ?>
</div>
