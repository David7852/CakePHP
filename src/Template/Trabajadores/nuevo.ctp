<?=$this->assign('title',"Trabajadores")?>
<div class="trabajadores form large-12 medium-11 columns content" style="width: 100%">
    <?= $this->Form->create($trabajador) ?>
    <fieldset>
        <legend><?= __('Agregar Trabajador') ?></legend>

        <?php
        echo $this->Form->input('nombre');
        echo $this->Form->input('apellido');
        echo $this->Form->input('cedula');

        $options = ['M'=>'Hombre',
            'F'=>'Mujer'];
        echo $this->Form->input('sexo',array('options'=>$options,'empty'=>true,'label'=>'Genero'));
        $options=["SBS"=>"SBS",
            "Legales"=>"Legales",
            "Parada de Planta"=>"Parada de Planta",
            "IT"=>"IT",
            "Comercializacion"=>"Comercializacion",
            "Finanzas"=>"Finanzas",
            "General"=>"General",
            "Recursos Humanos"=>"Recursos Humanos",
            "Mantenimiento"=>"Mantenimiento",
            "Gestion"=>"Gestion",
            "Servicios Generales"=>"Servicios Generales",
            "Tecnica"=>"Tecnica",
            "Confiabilidad"=>"Confiabilidad",
            "SHA"=>"SHA",
            "Operaciones"=>"Operaciones"];
        echo $this->Form->input('gerencia', array('options'=>$options,'empty'=>false,'escape'=>false));
        $options=["Gerente"=>"Gerente",
            "Supervisor"=>"Supervisor",
            "Analista"=>"Analista",
            "Pasante"=>"Pasante",
            "Superintendente"=>"Superintendente",
            "Jefe de planta"=>"Jefe de planta",
            "Secretario"=>"Secretario",
            "Consultor"=>"Consultor",
            "Consejero"=>"Consejero",
            "Otro"=>"Otro"];
        echo $this->Form->input('cargo', array('options'=>$options,'empty'=>false,'escape'=>false));
        echo $this->Form->input('area');
        $options = ['0' => 'Sede del complejo Jose',
            '1' => 'Sede edificio Laguna'];
        echo $this->Form->input('sede', array('options'=>$options,'empty'=>false,'escape'=>false));
        echo $this->Form->input('puesto_de_trabajo');
        echo $this->Form->input('extension');
        echo $this->Form->input('telefono_personal');
        echo $this->Form->input('rif');
        echo $this->Form->input('residencia');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>
</div>
