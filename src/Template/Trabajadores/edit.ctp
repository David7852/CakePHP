<?=$this->assign('title',"Trabajadores de Fertinitro")?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?=''?></li>
        <li class="usu" id="seleccion"><?= $this->Html->link(__('Usuarios'), ['controller' => 'Pages', 'action' => 'display','usuarios'])?></li>
        <!-- $ -->

        <?php if($this->request->session()->read('Auth.User.funcion')=='Visitante'): ?>
            <li><?= $this->Html->link(__('Trabajadores'), ['action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?></li>
        <?php else: ?>
        <li><?= $this->Form->postLink(
                __('Eliminar a ').h($trabajador->titulo),
                ['action' => 'delete', $trabajador->id],
                ['confirm' => __('¿Confirma querer eliminar al trabajador {0}?', $trabajador->titulo)]
            )
            ?></li>
        <li><?= $this->Html->link(__('Trabajadores'), ['action' => 'index']) ?></li>
        <?php endif; ?>
        <!-- $ -->
        <li class="sol"><?= $this->Html->link(__('Solicitudes'), ['controller' => 'Pages', 'action' => 'display','solicitudes'])?></li>
        <li class="inv"><?= $this->Html->link(__('Inventario'), ['controller' => 'Pages', 'action' => 'display','inventario'])?></li>
        <li class="tlf"><?= $this->Html->link(__('Telefonia'), ['controller' => 'Pages', 'action' => 'display','telefonia'])?></li>
    </ul>
</nav>
<div class="trabajadores form large-9 medium-8 columns content">
    <?= $this->Form->create($trabajador) ?>
    <fieldset>
        <legend><?= __('Editando a ').h($trabajador->titulo) ?></legend>
        <?php
            echo $this->Form->input('nombre');
            echo $this->Form->input('apellido');

            if($this->request->session()->read('Auth.User.funcion')!='Visitante'&&$this->request->session()->read('Auth.User.funcion')!='Operador') {
                echo $this->Form->input('cedula');
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
                echo $this->Form->input('cargo', array('options' => $options, 'empty' => false, 'escape' => false));
                echo $this->Form->input('area');
            }
            $options = ['M' => 'Hombre',
                        'F' => 'Mujer'];
            echo $this->Form->input('sexo',array('options'=>$options,'empty'=>true,'label'=>'Genero'));
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
