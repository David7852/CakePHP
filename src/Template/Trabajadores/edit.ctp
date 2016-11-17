<?=$this->assign('title',"Trabajadores de Fertinitro")?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Form->postLink(
                __('Eliminar a ').h($trabajador->titulo),
                ['action' => 'delete', $trabajador->id],
                ['confirm' => __('¿Confirma querer eliminar al trabajador {0}?', $trabajador->titulo)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Listar Trabajadores'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Contratos'), ['controller' => 'Contratos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nuevo Contrato'), ['controller' => 'Contratos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nuevo Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Listar Procesos'), ['controller' => 'Procesos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nuevo Proceso'), ['controller' => 'Procesos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="trabajadores form large-9 medium-8 columns content">
    <?= $this->Form->create($trabajador) ?>
    <fieldset>
        <legend><?= __('Editando a ').h($trabajador->titulo) ?></legend>
        <?php
            echo $this->Form->input('nombre');
            echo $this->Form->input('apellido');
            echo $this->Form->input('cedula');

            $options = ['M'=>'Hombre',
                        'F'=>'Mujer'];
            echo $this->Form->input('sexo',array('options'=>$options,'empty'=>true));

            $options=["IT"=>"IT",
                      "Recursos Humanos"=>"Recursos Humanos",
                      "Finanzas"=>"Finanzas",
                      "Contratacion"=>"Contratacion",
                      "Servicios Generales"=>"Servicios Generales",
                      "Planificacion"=>"Planificacion",
                      "Confiabilidad"=>"Confiabilidad",
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
            echo $this->Form->input('telefono_personal');
            echo $this->Form->input('rif');
            echo $this->Form->input('residencia');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>
</div>
