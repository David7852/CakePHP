<?php use Cake\Routing\Router;?>
<?=$this->assign('title',"Sistema de inventario")?>
<div class="large-4 medium-6 columns" id="actions-sidebar">
    <fieldset style="    padding-bottom: 0;
    padding-top: 0;
    padding-right: 15px;
    padding-left: 15px;
    height: 30rem;">
        <h1 class="delicate-text" >¡Bienvenido!<div class="gradient-line" style="height: 1px"></div></h1><br>
    <?= $this->Form->create() ?>
        <?php if($nombre!=null): ?>
            <?= $this->Form->input('nombre_de_usuario',['default'=>$nombre]) ?>
        <?php else: ?>
            <?= $this->Form->input('nombre_de_usuario') ?>
        <?php endif; ?>
    <?= $this->Form->input('clave',['label'=>'Contraseña','type'=>'password']) ?>
    <br>    <div class="gradient-line" style="height: 1px"></div>    <br>
    <?= str_replace("type=\"submit\"", "class='button' type=\"submit\" style=' float:none; display:block; margin: auto; width:100%; height:3rem '", $this->Form->submit('Ingresar', array('name' => 'btn'))) ?>
    <button type='submit' class="buttonsidenote-center">¿Olvidaste tu clave?</button>
    <?= $this->Form->end() ?>
    </fieldset>
</div>
<div class="usuarios form large-8 medium-8 columns content" style="background-image: url(/WIT/webroot/img/tubes.png); background-size: contain;    background-repeat: no-repeat;    z-index: -1;    position: fixed;    width: 100%;">
</div>