<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="tlf" id="seleccion"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <!-- $ -->
        <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
            <li><?= $this->Html->link(__('Lineas'), ['controller' => 'Lineas', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('Rentas'), ['controller' => 'Rentas', 'action' => 'index']) ?></li>
        <?php else: ?>
            <li><?= $this->Html->link(__('Editar'), ['action' => 'edit', $servicio->id]) ?> </li>
            <li><?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $servicio->id], ['confirm' => __('Are you sure you want to delete # {0}?', $servicio->id)]) ?> </li>
        <?php endif; ?>

        <!-- $ -->
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="usu" ><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
    </ul>
</nav>
<div class="servicios view large-9 medium-8 columns content">
    <h3><?= h($servicio->titulo) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($servicio->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cupo') ?></th>
            <td><?= h($servicio->cupo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Renta') ?></th>
            <td><?= $servicio->has('renta') ? $this->Html->link($servicio->renta->nombre, ['controller' => 'Rentas', 'action' => 'view', $servicio->renta->id]) : '' ?></td>
        </tr>
    </table>
    <?php if (!empty($servicio->consumos)): ?>
    <div class="related">
        <h4><?= __('Consumos') ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Factura') ?></th>
                <th scope="col"><?= __('Cupo') ?></th>
                <th scope="col"><?= __('Consumido') ?></th>
                <th scope="col"><?= __('Excedente') ?></th>
                <th scope="col"><?= __('Monto por exceso') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($servicio->consumos as $consumos): ?>
            <tr>
                <td><?= $this->Html->link($consumos->facturatitulo,
                        ['controller' => 'Facturas', 'action' => 'view', $consumos->factura_id]) ?></td>
                <td><?= h($consumos->cupo) ?></td>
                <td><?= h($consumos->consumido) ?></td>
                <td><?= h($consumos->excedente) ?></td>
                <td><?= h($consumos->monto_bs) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Consumos', 'action' => 'view', $consumos->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Consumos', 'action' => 'edit', $consumos->id]) ?>
                    <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?><!-->
                    <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Consumos', 'action' => 'delete', $consumos->id], ['confirm' => __('¿Confirma querer eliminar el consumo {0}?', $consumos->titulo)]) ?>
                <?php endif; ?>
                    </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
</div>
