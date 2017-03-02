<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="tlf" id="seleccion"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <!-- $ -->
        <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
            <li><?= $this->Html->link(__('Mis Consumos'), ['controller' => 'Consumos', 'action' => 'index', $this->request->session()->read('Auth.User.id')])?></li>
            <li><?= $this->Html->link(__('Mis Celulares'), ['controller' => 'Articulos', 'action' => 'inventario','0Celular']) ?></li>
        <?php else: ?>
            <li><?= $this->Html->link(__('Agregar Linea'), ['action' => 'add'], ['class'=>'viewLink']) ?></li>
            <li><?= $this->Html->link(__('Celulares'), ['controller' => 'Articulos', 'action' => 'inventario','0Celular']) ?></li>
            <li><?= $this->Html->link(__('Facturas'), ['controller' => 'Facturas', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('Rentas'), ['controller' => 'Rentas', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('Agregar Renta'), ['controller' => 'Rentas', 'action' => 'add'], ['class'=>'viewLink']) ?></li>
        <?php endif; ?>
        <!-- $ -->
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="usu" ><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
    </ul>
</nav>
<div class="lineas index large-9 medium-8 columns content">
    <h3><?= __('Lineas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('operadora') ?></th>
                <th scope="col"><?= $this->Paginator->sort('numero') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Equipo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Propietario') ?></th>
                <th scope="col"><?= $this->Paginator->sort('estado') ?></th>
                <th scope="col"><?= $this->Paginator->sort('observaciones') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lineas as $linea): ?>
            <tr>
                <td><?= h($linea->operadora) ?></td>
                <td><?= h($linea->numero) ?></td>
                <td><?= $linea->has('articulo') ? $this->Html->link($linea->articulo->titulo, ['controller' => 'Articulos', 'action' => 'view', $linea->articulo->id]) : 'Sin asignar' ?>
                    <?= $linea->has('articulo') ? "<img style='float: none; width: 3rem; margin-top: -7px; padding: 0.3rem;' src='/WIT/webroot/img/Modelos/".$linea->articulo->imagen."'>" : '' ?>
                </td>
                <td>
                    <?= $linea->has('articulo')&&$linea->articulo->asignado!='' ? $this->Html->link($linea->articulo->asignado, ['controller' => 'Trabajadores', 'action' => 'view', $linea->articulo->asignadoid]) : 'Sin asignar' ?>
                </td>
                <td>
                    <?= h($linea->estado) ?>
                </td>
                <td><?= h($linea->observaciones) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $linea->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $linea->id]) ?>
                <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?><!-->
                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $linea->id], ['confirm' => __('¿Confirma querer eliminar la linea {0}?', $linea->id)]) ?>
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
