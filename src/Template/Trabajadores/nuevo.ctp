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

        $options=["IT"=>"IT",
            "Recursos Humanos"=>"Recursos Humanos",
            "Finanzas"=>"Finanzas",
            "Contratacion"=>"Contratacion",
            "Servicios Generales"=>"Servicios Generales",
            "Planificacion"=>"Planificacion",
            "Confiabiliad"=>"Confiabiliad",
            "Mantenimiento"=>"Mantenimiento",
            "Produccion"=>"Produccion",
            "Gestion"=>"Gestion"];
        echo $this->Form->input('gerencia', array('options'=>$options,'empty'=>false,'escape'=>false));

        $options=["Gerente"=>"Gerente",
            "Supervisor"=>"Supervisor",
            "Supervisora"=>"Supervisora",
            "Analista"=>"Analista",
            "Pasante"=>"Pasante",
            "Superintendente"=>"Superintendente",
            "Jefe de planta"=>"Jefe de planta",
            "Jefa de planta"=>"Jefa de planta",
            "Secretaria"=>"Secretaria",
            "Secretario"=>"Secretario",
            "Consultor"=>"Consultor",
            "Consultora"=>"Consultora",
            "Consejera"=>"Consejera",
            "Consejero"=>"Consejero"];
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
