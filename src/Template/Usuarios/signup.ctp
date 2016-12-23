<?php use Cake\Routing\Router;?>
<div class="usuarios form large-12 medium-11 columns content">
    <fieldset>
        <legend><h1 style="color: #0a6b4c; font-weight: lighter; margin-bottom: 5px; line-height: normal; text-transform: none" >¿Ya eres un trabajador <br>registrado de FertiNitro?</h1></legend>
        <?php
        echo "<div style='display: inline-block; width:100%'>";
        echo "<h3 style='margin-bottom: 0;padding-bottom: 0; font-family: Raleway;font-weight: 400'>Si es asi, ingresa tu cedula. </h3>";
        echo str_replace(
                "input type=\"text\" name=\"cedula\" id=\"cedula\"",
                "input type=\"text\" name=\"cedula\" id=\"cedula\" style=\"text-align:center\"",
                str_replace("class=\"input text\"",
                    "class=\"input text\" style=\" display: block; text-align: center; margin: auto; width: 25rem;\"",
                    $this->Form->input('cedula',['label'=>""])));
        echo "</div>";
        echo "<h3 style='margin-bottom: 0;padding-bottom: 0;  font-family: Raleway; font-weight: 400'>Sino... </h3>";
        ?>
        <br>
        <a href="<?=Router::url(array('controller' => 'trabajadores', 'action' => 'add'))?>" class="button" style="display: block; text-align: center; margin: auto;float: none; width: 12rem; border-radius: 5px">¡Registrate!</a>
    </fieldset>
</div>