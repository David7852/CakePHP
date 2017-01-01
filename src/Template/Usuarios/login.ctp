<?php use Cake\Routing\Router;?>
<?=$this->assign('title',"Sistema de inventario")?>
<div class="large-4 medium-6 columns" id="actions-sidebar">
    <fieldset style="padding-top: 0;padding-right: 15px; padding-left: 15px">
        <h1 class="delicate-text" >¡Bienvenido!<div class="gradient-line" style="height: 1px"></div></h1><br>
    <?= $this->Form->create() ?>
    <?= $this->Form->input('nombre_de_usuario') ?>
    <?= $this->Form->input('clave',['label'=>'Contraseña','type'=>'password']) ?>
    <br>    <div class="gradient-line" style="height: 1px"></div>    <br>
    <?= str_replace("type=\"submit\"", "class='button' type=\"submit\" style=' float:none; display:block; margin: auto; width:100%; height:3rem '", $this->Form->submit('Ingresar', array('name' => 'btn'))) ?>
    <button button type='submit' class="buttonsidenote-center">¿Olvidaste tu clave?</button>
    <?= $this->Form->end() ?>
    </fieldset>
</div>
<div class="usuarios form large-8 medium-8 columns content">
</div>