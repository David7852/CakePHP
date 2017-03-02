<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="tlf" id="seleccion"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <!-- $ -->
        <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
            <li><?= $this->Html->link(__('Mis Lineas'), ['controller' => 'Lineas', 'action' => 'index',$this->request->session()->read('Auth.User.trabajador_id')]) ?></li>
            <li><?= $this->Html->link(__('Rentas'), ['controller' => 'Rentas', 'action' => 'index']) ?></li>
        <?php else: ?>
        <li><?= $this->Html->link(__('Agregar Consumo'), ['action' => 'add'], ['class'=>'viewLink']) ?></li>
        <li><?= $this->Html->link(__('Facturas'), ['controller' => 'Facturas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Servicios'), ['controller' => 'Servicios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Rentas'), ['controller' => 'Rentas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?></li>
        <?php endif; ?>
        <!-- $ -->
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="usu" ><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
    </ul>
</nav>
<div class="consumos index large-9 medium-8 columns content">
    <h3><?= __('Consumos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('factura_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('servicio_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('cupo') ?></th>
            <th scope="col"><?= $this->Paginator->sort('consumido') ?></th>
            <th scope="col"><?= $this->Paginator->sort('excedente') ?></th>
            <th scope="col"><?= $this->Paginator->sort('monto por exceso') ?></th>
            <th scope="col" class="actions"><?= __('Acciones') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($consumos as $consumo): ?>
            <tr>
                <td><?= $consumo->has('factura') ? $this->Html->link($consumo->factura->titulo, ['controller' => 'Facturas', 'action' => 'view', $consumo->factura_id]) : '' ?></td>
                <td><?= $consumo->has('servicio') ? $this->Html->link($consumo->servicio->titulo, ['controller' => 'Servicios', 'action' => 'view', $consumo->servicio->id]) : '' ?></td>
                <td><?= h($consumo->cupo) ?></td>
                <td><?= h($consumo->consumido) ?></td>
                <td><?= h($consumo->excedente) ?></td>
                <td><?= $this->Number->format($consumo->monto_bs).' Bs' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $consumo->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $consumo->id]) ?>
            <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?><!-->
                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $consumo->id], ['confirm' => __('¿Confirma querer eliminar el consumo {0}?', $consumo->titulo)]) ?>
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
</div>
