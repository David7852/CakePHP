<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Form->postLink(
                __('Eliminar'),
                ['action' => 'delete', $usuario->id],
                ['confirm' => __('¿Confirma querer eliminar al usuario {0}?', $usuario->nombre_de_usuario)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Listar Usuarios'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Trabajadores'), ['controller' => 'Trabajadores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nuevo Trabajador'), ['controller' => 'Trabajadores', 'action' => 'add']) ?></li>
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
    <fieldset>
        <legend><?= __('Editando a ').h($usuario->nombre_de_usuario) ?></legend>
        <?php
            echo $this->Form->input('nombre_de_usuario');
            echo $this->Form->input('email');
            echo $this->Form->input('clave_anterior',['type'=>'password','value'=>'','required'=>true]);
            echo $this->Form->input('clave',['label'=>'Nueva Clave','type'=>'password','value'=>'']);
            echo $this->Form->input('conf_clave',['label'=>'Reingrese Su Nueva Clave','type'=>'password','value'=>'']);
            if($this->request->session()->read('Auth.User.funcion')=='Superadministrador')
            {
                $options = ["Superadministrador" => "Superadministrador",
                    "Administrador" => "Administrador",
                    "Operador" => "Operador",
                    "Visitante" => "Visitante"];
                echo $this->Form->input('funcion', array('options'=>$options,'empty'=>false,'escape'=>false));
            }
            echo $this->Form->input('imagen');
        ?>
        <table>
        <tr>
            <td><?=$usuario->has('trabajador') ? $this->Html->link($usuario->trabajador->titulo, ['controller' => 'Trabajadores', 'action' => 'view', $usuario->trabajador->id]) : '' ?></td>
        </tr>
        </table>
    </fieldset>
    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>
</div>
