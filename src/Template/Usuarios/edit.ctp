<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="usu" id="seleccion"><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
        <!-- $ -->

        <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
            <li><?= $this->Html->link(__('Trabajadores'), ['action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?></li>
        <?php else: ?>
        <li><?= $this->Form->postLink(
                __('Eliminar'),
                ['action' => 'delete', $usuario->id],
                ['confirm' => __('¿Confirma querer eliminar al usuario {0}?', $usuario->nombre_de_usuario)]
            )
            ?></li>
            <li><?= $this->Html->link(__('Trabajadores'), ['action' => 'index']) ?> </li>
        <?php endif; ?>
        <!-- $ -->
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="tlf"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
    </ul>
</nav>
<div class="usuarios form large-9 medium-8 columns content">
    <?php use Cake\Auth\DefaultPasswordHasher;
    $hasher = new DefaultPasswordHasher();
    if($hasher->check($usuario->trabajador->cedula,$usuario->clave))
        echo "<p class='removablewarningnote' id='removable' onclick='removeFadeOut(document.getElementById(\"removable\"), 666);'>La clave de su usuario coincide con su numero de cédula de identidad. Es recomendable evitar incluir datos personales en su contraseña.</p>";
    if($hasher->check('fertinitro'.date("Y"),$usuario->clave))
        echo "<p class='removablewarningnote' id='removable' onclick='removeFadeOut(document.getElementById(\"removable\"), 666);'>Actualmente tiene asignada una clave poco segura. Consideré actualizar su clave cuanto antes.</p>";
        ?>
    <?= $this->Form->create($usuario) ?>
    <fieldset style="padding-bottom: 0.16rem;margin-bottom: 0.04rem">
        <legend><?= __('Editando a ').h($usuario->nombre_de_usuario) ?></legend>
        <?php
            $hasher = new DefaultPasswordHasher();
            echo $this->Form->input('nombre_de_usuario');
            echo $this->Form->input('email');
            echo $this->Form->input('clave_anterior',['label'=>'Clave Actual','type'=>'password','value'=>'','required'=>true]);
            echo $this->Form->input('clave',['label'=>'Nueva Clave','type'=>'password','value'=>'']);
            echo $this->Form->input('conf_clave',['label'=>'Reingrese Su Nueva Clave','type'=>'password','value'=>'','required'=>true]);
            echo $this->Form->input('pregunta',['label'=>'Pregunta Secreta','value'=>'']);
            echo $this->Form->input('respuesta',['value'=>'']);
            if($this->request->session()->read('Auth.User.funcion')=='Superadministrador')
            {
                $options = ["Superadministrador" => "Superadministrador",
                    "Administrador" => "Administrador",
                    "Operador" => "Operador",
                    "Visitante" => "Visitante"];
                echo $this->Form->input('funcion', array('options'=>$options,'empty'=>false,'escape'=>false));
            }
        ?>

    </fieldset>
    <table>
        <tr>
            <td><?=$usuario->has('trabajador') ? $this->Html->link($usuario->trabajador->titulo, ['controller' => 'Trabajadores', 'action' => 'view', $usuario->trabajador->id]) : '' ?></td>
        </tr>
    </table>
    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>
</div>
