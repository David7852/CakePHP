<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="tlf" id="seleccion"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <!-- $ -->
        <li><?= $this->Html->link(__('Dar Consumo'), ['controller'=> 'Consumos', 'action' => 'add','f'.$factura->linea_id],['style'=>'color:#D7782E']) ?></li>
        <li><?= $this->Html->link(__('Editar'), ['action' => 'edit', $factura->id]) ?> </li>
        <li><?= $this->Html->link(__('Facturas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Consumos'), ['controller' => 'Consumos', 'action' => 'index']) ?> </li>
        <!-- $ -->
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="usu" ><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
    </ul>
</nav>
<div class="facturas view large-9 medium-8 columns content">
    <h3><?= 'Factura del '.h($factura->titulo) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Linea') ?></th>
            <td><?= $factura->has('linea') ? $this->Html->link($factura->linea->numero, ['controller' => 'Lineas', 'action' => 'view', $factura->linea_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Balance') ?></th>
            <td><?= $this->Number->format($factura->balance).' Bs' ?></td>
        </tr>

        <tr>
            <th scope="row"><?= __('IVA') ?></th>
            <td><?= $this->Number->format($factura->iva).' Bs' ?></td>
        </tr>

        <tr>
            <th scope="row"><?= __('Cargos Extra') ?></th>
            <td><?= $this->Number->format($factura->cargos_extra).' Bs' ?></td>
        </tr>

        <tr>
            <th scope="row"><?= __('Desde') ?></th>
            <td><?= h($factura->desde) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hasta') ?></th>
            <td><?= h($factura->hasta) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Paguese Antes De') ?></th>
            <td><?= h($factura->paguese_antes_de) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Numero De Cuenta') ?></th>
            <td><?= h($factura->numero_de_cuenta) ?></td>
        </tr>
    </table>
    <?php if (!empty($factura->consumos)): ?>
    <div class="related">
        <h4><?= __('Consumos') ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Detalle') ?></th>
                <th scope="col"><?= __('Servicio') ?></th>
                <th scope="col"><?= __('Consumido') ?></th>
                <th scope="col"><?= __('Excedente') ?></th>
                <th scope="col"><?= __('Monto por exceso') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($factura->consumos as $consumos): ?>
            <tr>
                <td><?= h($consumos->detalle) ?></td>
                <td><?= $this->Html->link($consumos->servicionombre, ['controller' => 'Servicios', 'action' => 'view', $consumos->servicio_id])?></td>
                <td><?= h($consumos->consumido) ?></td>
                <td><?= h($consumos->excedente) ?></td>
                <td><?= h($consumos->monto_bs).' Bs' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Consumos', 'action' => 'view', $consumos->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Consumos', 'action' => 'edit', $consumos->id]) ?>
                <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?><!-->
                    <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Consumos', 'action' => 'delete', $consumos->id], ['confirm' => __('¿Confirma querer eliminar el consumo de {0}?', $consumos->titulo)]) ?>
                <?php endif; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
</div>
