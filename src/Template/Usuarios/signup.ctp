<?php use Cake\Routing\Router;?>
<div class="usuarios form large-12 medium-11 columns content" style="width: 100%">
    <form method="post" accept-charset="utf-8" action="/WIT/usuarios/registrate">
    <div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
        <fieldset>
            <legend><h1 style="color: #0a6b4c; font-weight: lighter; margin-bottom: 1rem; line-height: normal; text-transform: none;" >¿Ya eres un trabajador de FertiNitro?</h1></legend>
            <div style='display: inline-block; width:100%; margin-bottom:-0.4rem'>
                <?="<h4 style=\"color: #417664; margin-bottom: 0;padding-bottom: 0; font-family: raleway, Roboto, Century gothic, Segoe ui, sans-serif, sans-serif;font-weight: 400;text-shadow: 0px 0px 1px rgba(65, 118, 100, 0.3)\">Si es asi, ingresa tu cedula. </h4>";?>
                <br>
                <div style="text-align: center; height: 5rem; position: relative;">
                    <?php echo str_replace(
                            "input type=\"text\" name=\"cedula\" id=\"cedula\"",
                            "input type=\"text\" name=\"cedula\" maxlength=\"8\" id=\"cedula\" style=\"text-align:center;\"",
                            str_replace("class=\"input text\"",
                                "class=\"input text\" style=\" display: inline-block; text-align: center; margin: auto;margin-left: -1.05rem;\"",
                                $this->Form->input('cedula',['label'=>""])));?>
                        <button id="dif" type="submit" style="display: inline; position: absolute; margin-left: -1.75rem; top: -2%;" class="_W6g _S6g _ufp nb-fades">
                            <g-fab class="_jAg">
                                <span class="_HAg _wtf">
                                    <svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"></path>
                                    </svg>
                                </span>
                            </g-fab>
                        </button>
                </div>
            </div>
            <br><br><br>
            <div class="gradient-line-red" style="width: 75%;display: block; text-align: center;margin: auto;float: none;"></div>
            <?php echo "<h4 style='padding-bottom: 0;  font-family: raleway, Roboto, Century gothic, Segoe ui, sans-serif; font-weight: 400'>Si no es asi... </h4>";?>
            <a href="<?=Router::url(array('controller' => 'trabajadores', 'action' => 'nuevo'))?>" id="red-button" class="button" style="display: block; width: 10.6rem;">Registrate</a>
        </fieldset>
    </form>
</div>