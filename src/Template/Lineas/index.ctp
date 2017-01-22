<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="tlf" id="seleccion"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <!-- $ -->
        <li><?= $this->Html->link(__('Nueva Linea'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Celulares'), ['controller' => 'Articulos', 'action' => 'inventario','Celular']) ?></li>
        <li><?= $this->Html->link(__('Facturas'), ['controller' => 'Facturas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Rentas'), ['controller' => 'Rentas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nueva Renta'), ['controller' => 'Rentas', 'action' => 'add']) ?></li>
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
                <th scope="col"><?= $this->Paginator->sort('numero') ?></th>
                <th scope="col"><?= $this->Paginator->sort('puk') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pin') ?></th>
                <th scope="col"><?= $this->Paginator->sort('codigo_sim') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Equipo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('observaciones') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lineas as $linea): ?>
            <tr>
                <td><?= h($linea->numero) ?></td>
                <td><?= $this->Number->format($linea->puk) ?></td>
                <td><?= $this->Number->format($linea->pin) ?></td>
                <td><?= h($linea->codigo_sim) ?></td>
                <td><?= $linea->has('articulo') ? $this->Html->link($linea->articulo->titulo, ['controller' => 'Articulos', 'action' => 'view', $linea->articulo->id]) : '' ?></td>
                <td><?= h($linea->observaciones) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $linea->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $linea->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $linea->id], ['confirm' => __('¿Confirma querer eliminar la linea {0}?', $linea->id)]) ?>
                </td>
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
