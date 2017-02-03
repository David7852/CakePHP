<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>

        <li class="inv" id="seleccion"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <!-- $ -->
        <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
            <li><?= $this->Html->link(__('Solicitar'), ['controller'=>'Procesos','action' => 'solicitar']) ?></li>
            <li><?= $this->Html->link(__('Accesorios'), ['controller'=>'Accesorios','action' => 'index']) ?></li>
        <?php else: ?>
            <li><?= $this->Html->link(__('Nuevo Articulo'), ['action' => 'add']) ?></li>
            <li><?= $this->Html->link(__('Nuevo Modelo'), ['controller' => 'Modelos', 'action' => 'add']) ?></li>
        <?php endif; ?>
        <!-- $ -->
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="tlf"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <li class="usu"><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
    </ul>
</nav>
<div class="articulos index large-9 medium-8 columns content">
    <h3 style="text-transform: capitalize"><?php
        if(substr($tipo, -1)=="s")
            echo $tipo;
        elseif(substr($tipo, -1)=="a"||substr($tipo, -1)=="e"||substr($tipo, -1)=="i"||substr($tipo, -1)=="o"||substr($tipo, -1)=="u")
            echo $tipo."s";
        elseif(substr($tipo, -1)=="z")
            echo substr($tipo,0, -1)."ces";
        else
            echo $tipo."es";
        ?></h3>
    <?php if(!$articulos->isEmpty()): ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('serial') ?></th>
            <th scope="col"><?= $this->Paginator->sort('tipo') ?></th>
            <th scope="col"><?= $this->Paginator->sort('modelo_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('imagen') ?></th>
            <th scope="col"><?= $this->Paginator->sort('ubicacion') ?></th>
            <th scope="col"><?= $this->Paginator->sort('estado')?></th>
            <th scope="col"><?= $this->Paginator->sort('datos') ?></th>
            <th scope="col" class="actions"><?= __('Acciones') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($articulos as $articulo): ?>
            <tr>
                <td><?= h($articulo->serial) ?></td>
                <td><?= $articulo->has('modelo') ? $articulo->modelo->tipo_de_articulo : '' ?></td>
                <td><?= $articulo->has('modelo') ? $this->Html->link($articulo->modelo->marcamodelo, ['controller' => 'Modelos', 'action' => 'view', $articulo->modelo->id]) : '' ?></td>
                <td id="overlayed"><?= '<figure><img src="/WIT/webroot/img/Modelos/'.$articulo->modelo->imagen.'"></figure>' ?></td>
                <td><?= h($articulo->ubicacion) ?></td>
                <td><?= h($articulo->estado) ?></td>
                <td><?= h($articulo->datos) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $articulo->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $articulo->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $articulo->id], ['confirm' => __('¿Confirma querer eliminar el articulo {0}?', $articulo->titulo)]) ?>
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
    <?php else: ?>
    <h4>No hay existencias en el inventario, por el momento.</h4>
    <?php endif; ?>

</div>
