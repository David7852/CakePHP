<?=$this->assign('title',"Sistema de inventario")?>
<div class="large-3 medium-4 columns" id="actions-sidebar">
    <fieldset>
    <h1 class="delicate-text" >¡Bienvenido!<div class="gradient-line"></h1><br>
    <?= $this->Form->create() ?>
    <?= $this->Form->input('nombre_de_usuario') ?>
    <?= $this->Form->input('clave',['label'=>'Contraseña','type'=>'password']) ?>
    <?= $this->Form->button('Ingresar') ?>
    <?= $this->Form->end() ?>
    </fieldset>
</div>

<div class="usuarios form large-9 medium-8 columns content">

</div>