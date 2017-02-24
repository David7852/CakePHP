<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="usu" id="seleccion"><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
        <!-- $ -->
        <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
            <li><?= $this->Html->link(__('Editar'), ['action' => 'edit', $usuario->id]) ?> </li>
            <li><?= $this->Html->link(__('Trabajadores'), ['controller' => 'Trabajadores','action' => 'index']) ?> </li>
        <?php else: ?>
        <li><?= $this->Html->link(__('Editar'), ['action' => 'edit', $usuario->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $usuario->id], ['confirm' => __('¿Confirma querer eliminar al usuario {0}?', $usuario->nombre_de_usuario)]) ?> </li>
        <?php endif; ?>
        <!-- $ -->
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="tlf"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
    </ul>
</nav>
<div class="usuarios view large-9 medium-8 columns content">
    <h3><?= h($usuario->funcion).": ".h($usuario->nombre_de_usuario) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre Completo') ?></th>
            <td><?= $usuario->has('trabajador') ? $this->Html->link($usuario->trabajador->titulo, ['controller' => 'Trabajadores', 'action' => 'view', $usuario->trabajador->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($usuario->email) ?></td>
        </tr>
    </table>
    <?php use Cake\Auth\DefaultPasswordHasher;
        $hasher = new DefaultPasswordHasher();
        if($hasher->check
        ($usuario->trabajador->cedula,
            $usuario->clave))
        echo "<p class='warningnote'>Actualmente la clave de su usuario coincide con su numero de cédula de identidad. Recomendamos editar su usuario y cambiar su contraseña.</p>";
        if($hasher->check('fertinitro'.date("Y"),$usuario->clave))
        echo "<p class='warningnote'>Actualmente tiene asignada una clave poco segura. Consideré actualizar su clave cuanto antes.</p>";
        ?>
</div>
