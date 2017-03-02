<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="usu" id="seleccion"><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
        <!-- $ -->

        <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
            <li><?= $this->Html->link(__('Trabajadores'), ['action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('Contratos'), ['controller' => 'Contratos', 'action' => 'index']) ?></li>
        <?php else: ?>
        <li><?= $this->Html->link(__('Agregar Usuario'), ['action' => 'add'], ['class'=>'viewLink']) ?></li>
        <li><?= $this->Html->link(__('Trabajadores'), ['controller' => 'Trabajadores', 'action' => 'index']) ?></li>
        <?php endif; ?>
        <!-- $ -->
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="tlf"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
    </ul>
</nav>
<div class="usuarios index large-9 medium-8 columns content">
    <h3><?= __('Usuarios') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('nombre_de_usuario') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('trabajador_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('funcion') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>

        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= h($usuario->nombre_de_usuario) ?></td>
                <td><?= h($usuario->email) ?></td>
                <td><?= $usuario->has('trabajador') ? $this->Html->link($usuario->trabajador->titulo, ['controller' => 'Trabajadores', 'action' => 'view', $usuario->trabajador->id]) : '' ?></td>
                <td><?= h($usuario->funcion) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $usuario->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $usuario->id]) ?>
                <?php if($this->request->session()->read('Auth.User.funcion')!='Visitante'): ?><!-->
                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $usuario->id], ['confirm' => __('¿Confirma querer eliminar al usuario {0}?', $usuario->nombre_de_usuario)]) ?>
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
