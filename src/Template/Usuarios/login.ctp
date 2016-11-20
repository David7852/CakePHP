<?=$this->assign('title',"Sistema de inventario")?>
<div class="large-3 medium-4 columns" id="actions-sidebar">
    <h1>¡Bienvenido!</h1>
    <?= $this->Form->create() ?>
    <?= $this->Form->input('nombre_de_usuario') ?>
    <?= $this->Form->input('clave',['label'=>'Contraseña','type'=>'password']) ?>
    <?= $this->Form->button('Ingresar') ?>
    <?= $this->Form->end() ?>
</div>

<div class="usuarios form large-9 medium-8 columns content">

</div>