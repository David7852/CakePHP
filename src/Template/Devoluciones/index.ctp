<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="sol" id="seleccion"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <!-- $ -->

        <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
            <li><?= $this->Html->link(__('Solicitar'), ['controller'=>'Procesos','action' => 'solicitar']) ?></li>
            <li><?= $this->Html->link(__('Solicitudes'), ['action' => 'index']) ?> </li>
        <?php else: ?>
        <li><?= $this->Html->link(__('Procesos'), ['controller' => 'Procesos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?></li>
        <?php endif; ?>
        <!-- $ -->
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="tlf"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <li class="usu"><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
    </ul>
</nav>
<div class="devoluciones index large-9 medium-8 columns content">
    <h3><?= __('Devoluciones') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('proceso_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Solicitante') ?></th>
                <th scope="col"><?= $this->Paginator->sort('articulo_id') ?></th>
                <th scope="col" class="actions"><?= __('Aciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($devoluciones as $devolucion): ?>
            <tr>
                <td><?= $devolucion->has('proceso') ? $this->Html->link($devolucion->proceso->titulo, ['controller' => 'Procesos', 'action' => 'view', $devolucion->proceso->id]) : '' ?></td>
                <td>
                    <?= $devolucion->has('proceso') ? $this->Html->link($devolucion->proceso->solicitante, ['controller' => 'Trabajadores', 'action' => 'view', $devolucion->proceso->solicitanteid]) : 'Sin asignar' ?>
                </td>
                <td><?= $devolucion->has('articulo') ? $this->Html->link($devolucion->articulo->titulo, ['controller' => 'Articulos', 'action' => 'view', $devolucion->articulo->id]) : '' ?>
                    <img style="float: none; width: 3rem; margin-top: -7px; padding: 0.3rem;" src="<?= '/WIT/webroot/img/Modelos/'.$devolucion->articulo->imagen ?>">
                </td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $devolucion->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $devolucion->id]) ?>
                <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?><!-->
                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $devolucion->id], ['confirm' => __('¿Confirma querer eliminar la devolucion {0}?', $devolucion->titulo)]) ?>
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
