<?=$this->assign('title',"Contratos de los trabajadores")?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="usu" id="seleccion"><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
        <!-- $ -->
        <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
            <li><?= $this->Html->link(__('Contratos'), ['controller' => 'Contratos', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('Trabajadores'), ['controller' => 'Trabajadores', 'action' => 'index']) ?></li>
        <?php else: ?>
        <li><?= $this->Html->link(__('Editar'), ['action' => 'edit', $contrato->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $contrato->id], ['confirm' => __('¿Confirma querer eliminar el contrato {0}?', $contrato->titulo)]) ?> </li>
        <?php endif; ?>
        <!-- $ -->
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="tlf"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
    </ul>
</nav>
<div class="contratos view large-9 medium-8 columns content">
    <h3><?= 'Contraro de '.h($contrato->titulo) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Trabajador') ?></th>
            <td><?= $contrato->has('trabajador') ? $this->Html->link($contrato->trabajador->titulo, ['controller' => 'Trabajadores', 'action' => 'view', $contrato->trabajador->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha De Inicio') ?></th>
            <td><?= h($contrato->fecha_de_inicio) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha De Culminacion') ?></th>
            <td><?= h($contrato->fecha_de_culminacion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo De Contrato') ?></th>
            <td><?= h($contrato->tipo_de_contrato) ?></td>
        </tr>
    </table>
</div>
