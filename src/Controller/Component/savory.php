<?php
/**
 * Created by PhpStorm.
 * User: pasanteit
 * Date: 10/02/2017
 * Time: 08:32 AM
 */

namespace App\Controller\Component;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

class savory
{
    public function gettrbdata()
    {
        $trabajadores=TableRegistry::get('Trabajadores')->find('all')->count();
        return '<dfn style="color: rgb(180,40,176); font-size: large; font-style: normal ; font-weight: bold">'.$trabajadores.'</dfn>'.' Trabajadores de la familia 
            <dfn style="font-size: large;color: rgb(57,115,30); font-style: normal ; font-weight: bold">Ferti</dfn><dfn style="font-size: large;color: rgb(185,230,51); font-style: normal ; font-weight: bold">Nitro</dfn> ya forman parte de WIT.<br>Tu participación es valiosa y nos ayuda a mejorar la calidad de nuestro servicio.<a href="/WIT/registrate" class="button" style="float: right; transition: all 1s; margin-bottom: 0; top: -.25rem; width: 8rem; text-align: center; padding: 0; margin-right: 3.85rem;">¡Únete!</a>';
    }
    public function getinvdata()
    {
        $articulos=TableRegistry::get('Articulos')->find('all')->count();
        $asig=TableRegistry::get('Procesos')->find('all')->where(['tipo ='=>'Asignacion'])->count();
        $dev=TableRegistry::get('Procesos')->find('all')->where(['tipo ='=>'Devolucion'])->count();
        $mix=TableRegistry::get('Procesos')->find('all')->where(['tipo ='=>'Mixto'])->count();
        return 'Disponemos de <dfn style="font-size: large;color: rgb(222,76,34); font-style: normal ;">' .$articulos.' Artículos'.'</dfn> informaticos, los cuales han sido parte de<br> <dfn style="font-size: large;color: rgb(255,214,43); font-style: normal ">' .($asig+$mix).' Procesos'.
            '</dfn> procesos de asignación y <dfn style="font-size: large;color: rgb(38,255,240); font-style: normal ; ">' .($dev+$mix).' Procesos'.'</dfn> de devolución.<br> ¡Tu puedes ser parte! Realizar una solicitud es simple y transparente.
            <a href="/WIT/solicitar" class="button" style="float: right; transition: all 1s; margin-bottom: 0; top: -.25rem; width: 8rem; text-align: center; padding: 0; margin-right: 3.85rem;">¡Solicitar!</a>';
    }
    public function gettlfdata()
    {
        $mo = array();
        $models = TableRegistry::get('Modelos')->find('all')
            ->where(['tipo_de_articulo LIKE' => 'Celular%']);
        foreach ($models as $m)
            array_push($mo, $m->id);
        if (!empty($mo))
            $tlf = TableRegistry::get('Articulos')->find('all', array('conditions' => array('Articulos.modelo_id IN' => $mo)))->count();
        else
            $tlf= 0;
        $lins=TableRegistry::get('Lineas')->find('all')->where(['estado ='=>'Activa'])->count();
        return 'En nuestra disposición están <dfn style="font-size: large;color: rgb(206,255,55); font-style: normal ">' .$tlf.' Teléfonos'.'</dfn>'. ' celulares y <dfn style="font-size: large;color: rgb(56,247,132); font-style: normal">' .$tlf.' Lineas'.'</dfn>'.' Activas. <br> WIT te ayudara a dar seguimiento a tus consumos y lineas asociadas de <dfn style="font-size: large;color: rgb(57,115,30); font-style: normal ; font-weight: bold">Ferti</dfn><dfn style="font-size: large;color: rgb(185,230,51); font-style: normal ; font-weight: bold">Nitro</dfn>.';
    }
    public function getcontactinfo()
    {
        return 'Estamos atentos a tus sugerencias. Cualquier duda, comentario o sugerencia, escribanos a itsoporte@fertinitro.com.';
    }

}