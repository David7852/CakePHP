<?=$this->assign('title',"Sistema de inventario")?>
<div class="large-4 medium-4 columns" id="actions-sidebar">
    <fieldset style="padding-top: 0;padding-right: 15px; padding-left: 15px">
    <h1 class="delicate-text" >¡Bienvenido!<div class="gradient-line" style="height: 1px"></h1><br>
    <?= $this->Form->create() ?>
    <?= $this->Form->input('nombre_de_usuario') ?>
    <?= $this->Form->input('clave',['label'=>'Contraseña','type'=>'password']) ?>
    <?= $this->Form->button('Ingresar') ?>
    <?= $this->Form->end() ?>
    </fieldset>
</div>

<div class="usuarios form large-8 medium-8 columns content">

</div>