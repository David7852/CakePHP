<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Listar Usuarios'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Trabajadores'), ['controller' => 'Trabajadores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nuevo Trabajador'), ['controller' => 'Trabajadores', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="usuarios form large-9 medium-8 columns content">
    <?= $this->Form->create($usuario) ?>
    <fieldset>
        <legend><?= __('Nuevo Usuario') ?></legend>
        <?php
            echo $this->Form->input('nombre_de_usuario');
            echo $this->Form->input('email');
            echo $this->Form->input('clave',['type'=>'password']);
            if($this->request->session()->read('Auth.User.funcion')!='Visitante'){
            $options = ["Superadministrador"=>"Superadministrador",
                        "Administrador"=>"Administrador",
                        "Operador"=>"Operador",
                        "Visitante"=>"Visitante"];
            echo $this->Form->input('funcion', array('options'=>$options,'empty'=>false,'escape'=>false));}
            echo $this->Form->input('trabajador_id', ['options' => $trabajadores]);
            echo $this->Form->input('imagen');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>
</div>
