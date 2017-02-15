<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="tlf" id="seleccion"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <!-- $ -->

        <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
            <li><?= $this->Html->link(__('Mis Lineas'), ['controller' => 'Lineas', 'action' => 'index',$this->request->session()->read('Auth.User.trabajador_id')]) ?></li>
            <li><?= $this->Html->link(__('Consumos'), ['action' => 'index']) ?> </li>
        <?php else: ?>
        <li><?= $this->Html->link(__('Editar'), ['action' => 'edit', $consumo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $consumo->id], ['confirm' => __('¿Confirma querer eliminar el consumo {0}?', $consumo->titulo)]) ?> </li>
        <li><?= $this->Html->link(__('Consumos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Facturas'), ['controller' => 'Facturas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Servicios'), ['controller' => 'Servicio', 'action' => 'index']) ?> </li>
        <?php endif; ?>
        <!-- $ -->
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="usu" ><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
    </ul>
</nav>
<div class="consumos view large-9 medium-8 columns content">
    <h3><?= h($consumo->titulo) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Factura') ?></th>
            <td><?= $consumo->has('factura') ? $this->Html->link($consumo->factura->titulo, ['controller' => 'Facturas', 'action' => 'view', $consumo->factura->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Servicio') ?></th>
            <td><?= $consumo->has('servicio') ? $this->Html->link($consumo->servicio->titulo, ['controller' => 'Servicio', 'action' => 'view', $consumo->servicio->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cupo') ?></th>
            <td><?= h($consumo->cupo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Consumido') ?></th>
            <td><?= h($consumo->consumido) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Excedente') ?></th>
            <td><?= h($consumo->excedente) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Monto por exceso') ?></th>
            <td><?= $this->Number->format($consumo->monto_bs).' Bs' ?></td>
        </tr>
    </table>
</div>
