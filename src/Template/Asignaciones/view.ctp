<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>

        <li class="sol" id="seleccion"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <!-- $ -->
        <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
            <li><?= $this->Html->link(__('Solicitar'), ['controller'=>'Procesos','action' => 'solicitar']) ?></li>
            <li><?= $this->Html->link(__('Solicitudes'), ['action' => 'index']) ?> </li>
        <?php else: ?>
        <li><?= $this->Html->link(__('Editar'), ['action' => 'edit', $asignacion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $asignacion->id], ['confirm' => __('¿Confirma querer eliminar la asignacion de {0}?', $asignacion->titulo)]) ?> </li>
        <?php endif; ?>
        <!-- $ -->
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="tlf"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
        <li class="usu"><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
    </ul>
</nav>
<div class="asignaciones view large-9 medium-8 columns content">
    <h3><?= h($asignacion->titulo) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Proceso') ?></th>
            <td><?= $asignacion->has('proceso') ? $this->Html->link($asignacion->proceso->titulo, ['controller' => 'Procesos', 'action' => 'view', $asignacion->proceso->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Articulo') ?></th>
            <td><?= $asignacion->has('articulo') ? $this->Html->link($asignacion->articulo->titulo, ['controller' => 'Articulos', 'action' => 'view', $asignacion->articulo->id]) : '' ?>
                <img style="float: right; width: 3rem; margin-top: -7px; padding: 0.3rem;" src="<?= '/WIT/webroot/img/Modelos/'.$asignacion->articulo->imagen ?>">
            </td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hasta') ?></th>
            <td><?= h($asignacion->hasta) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estado') ?></th>
            <td style="color: #be140b"><?= h($asignacion->estado) ?></td>
        </tr>
    </table>
</div>
