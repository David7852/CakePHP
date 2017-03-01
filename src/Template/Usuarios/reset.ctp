<?php use Cake\Routing\Router;?>
<figure style="margin: 0.5rem 0 -1rem 0">
    <img class="center-image" src="/WIT/webroot/img/forget.png">
</figure>
<div class="usuarios form large-12 medium-11 columns content" style="width: 100%; padding-top:0.2rem">
        <div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
        <fieldset>
            <legend><h1 style="color: #0a6b4c; font-weight: lighter; margin-bottom: 1rem; line-height: normal; text-transform: none;" >¿Olvidaste tu clave?...<br>Rellena los datos y obtén otra.</h1></legend>
            <br>
            <?= str_replace("method=\"post\"","class='medium-6' method=\"post\" style='display: block; margin:auto; margin-bottom:-0.4rem; float:none'",$this->Form->create()) ?>
                <?= $this->Form->input('nombre') ?>
                <?= $this->Form->input('apellido') ?>
                <?= $this->Form->input('cedula') ?>
                <?php if($usuario->pregunta!=null):?>
                    <?= $this->Form->input('respuesta',['label'=>h($usuario->pregunta)]) ?>
                <?php endif;?>
                <?= str_replace("type=\"submit\"", "type=\"submit\" id='red-button' style=' float:none; display:block; margin: auto; height:3rem;'", $this->Form->button(__('Reiniciar mi contraseña'))) ?>
            <?= $this->Form->end() ?>
            <br>
        </fieldset>
</div>