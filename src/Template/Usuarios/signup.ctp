<?php use Cake\Routing\Router;?>
<div class="usuarios form large-12 medium-11 columns content">
    <fieldset>
        <legend><h1 style="color: #0a6b4c; font-weight: lighter; margin-bottom: 5px; line-height: normal; text-transform: none" >¿Ya eres un trabajador <br>registrado de FertiNitro?</h1></legend>
        <div style='display: inline-block; width:100%'>
            <?="<h3 style='margin-bottom: 0;padding-bottom: 0; font-family: Raleway;font-weight: 400'>Si es asi, ingresa tu cedula. </h3>";?>
            <div style="text-align: center; height: 5rem; position: relative;">
                <?php echo str_replace(
                        "input type=\"text\" name=\"cedula\" id=\"cedula\"",
                        "input type=\"text\" name=\"cedula\" id=\"cedula\" style=\"text-align:center\"",
                        str_replace("class=\"input text\"",
                            "class=\"input text\" style=\" display: inline-block; text-align: center; margin: auto; width: 25rem;\"",
                            $this->Form->input('cedula',['label'=>""])));?>
                <g-right-button style="display: inline;
    position: absolute;
    padding-left: 1rem;
    width: 5rem;
    margin: auto;
    top: -5%;" class="ifry3ieXsFig-98UL0CHUQk0 _W6g _S6g  _ufp nb-fades" jsaction="r.U_cbV_uMIhg" data-rtid="ifry3ieXsFig" jsl="$x 3;" aria-label="Next" role="button" tabindex="0" data-ved="0ahUKEwi0tbmOi47RAhXFOCYKHVD5DY0QoG4INg">
                    <g-fab class="_jAg _uqh" style="background-color:#fff;color:#757575;">
                        <span class="_HAg _wtf _Mtf">
                            <svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"></path>
                            </svg>
                        </span>
                    </g-fab>
                </g-right-button>
            </div>
        </div>
        <?php echo "<h3 style='margin-bottom: 0;padding-bottom: 0;  font-family: Raleway; font-weight: 400'>Sino... </h3>";?>
        <br>
        <a href="<?=Router::url(array('controller' => 'trabajadores', 'action' => 'add'))?>" class="button" style="display: block; text-align: center; margin: auto;float: none; width: 12rem; border-radius: 5px">¡Registrate!</a>
    </fieldset>
</div>