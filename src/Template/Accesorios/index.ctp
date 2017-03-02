<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="inv" id="seleccion"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <!-- $ -->
        <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
            <li><?= $this->Html->link(__('Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('Solicitar'), ['controller'=>'Procesos','action' => 'solicitar']) ?></li>
        <?php else: ?>
        <li><?= $this->Html->link(__('Agregar Accesorio'), ['action' => 'add'], ['class'=>'viewLink']) ?></li>
        <li><?= $this->Html->link(__('Articulos'), ['controller' => 'Articulos', 'action' => 'index']) ?></li>
        <?php endif; ?>
        <!-- $ -->
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="tlf"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <li class="usu"><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
    </ul>
</nav>
<div class="accesorios index large-9 medium-8 columns content">
    <h3><?= __('Accesorios') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('descripcion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('estado') ?></th>
                <th scope="col"><?= $this->Paginator->sort('articulo_id') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($accesorios as $accesorio): ?>
            <tr>
                <td><?= h($accesorio->descripcion) ?></td>
                <td><?= h($accesorio->estado) ?></td>
                <td><?= $accesorio->has('articulo') ? $this->Html->link($accesorio->articulo->titulo, ['controller' => 'Articulos', 'action' => 'view', $accesorio->articulo->id]) : '' ?>
                    <img style="float: none; width: 3rem; margin-top: -7px; padding: 0.3rem;" src="<?= '/WIT/webroot/img/Modelos/'.$accesorio->articulo->imagen ?>">
                </td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $accesorio->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $accesorio->id]) ?>
                <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?><!-->
                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $accesorio->id], ['confirm' => __('¿Confirma querer eliminar el accesorio: {0}?', $accesorio->titulo)]) ?>
                <?php endif; ?>
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
