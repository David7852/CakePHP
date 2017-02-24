<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use App\Controller\ProcesosController;
use Cake\ORM\TableRegistry;
/**
 * Proceso Entity
 *
 * @property int $id
 * @property string $motivo
 * @property string $tipo
 * @property \Cake\I18n\Time $fecha_de_aprobacion
 * @property \Cake\I18n\Time $fecha_de_complecion
 * @property string $estado
 * @property string $observaciones
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Asignacion[] $asignaciones
 * @property \App\Model\Entity\Devolucion[] $devoluciones
 * @property \App\Model\Entity\Trabajador[] $trabajadores
 */
class Proceso extends Entity
{
    protected function _getTitulo()
    {
        $solicitante=$this->_getSolicitante();
        if($this->_properties['tipo']=='Asignacion')
            return $solicitante!='Sin solicitante' ? $this->_properties['tipo']." para ".$solicitante : $this->_properties['tipo'].' '.$solicitante;
        return $solicitante!='Sin solicitante' ? $this->_properties['tipo']." de ".$solicitante : $this->_properties['tipo'].' '.$solicitante;
    }
    protected function _getEncargadotrb()
    {
        $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
            ->where(['proceso_id ='=>$this->_properties['id']])
            ->andWhere(['rol ='=>'Encargado']);
        if($pro_tra==null||$pro_tra->isEmpty())
            return null;
        foreach ($pro_tra as $tr)
            return TableRegistry::get('Trabajadores')->get($tr->trabajador_id);
    }
    protected function _getSupervisortrb()
    {
        $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
            ->where(['proceso_id ='=>$this->_properties['id']])
            ->andWhere(['rol ='=>'Supervisor']);
        if($pro_tra==null||$pro_tra->isEmpty())
            return null;
        foreach ($pro_tra as $tr)
            return TableRegistry::get('Trabajadores')->get($tr->trabajador_id);
    }
    protected function _getSolicitantetrb()
    {
        $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
            ->where(['proceso_id ='=>$this->_properties['id']])
            ->andWhere(['rol ='=>'Solicitante']);
        if($pro_tra==null||$pro_tra->isEmpty())
            return null;
        foreach ($pro_tra as $solicitante)
            return TableRegistry::get('Trabajadores')->get($solicitante->trabajador_id);
    }
    protected function _getSolicitante()
    {
        $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
            ->where(['proceso_id ='=>$this->_properties['id']])
            ->andWhere(['rol ='=>'Solicitante']);
        if($pro_tra==null||$pro_tra->isEmpty())
            return 'Sin solicitante';
        $solicitantes='';
        foreach ($pro_tra as $solicitante)
        {
            if($solicitantes!='')
                $solicitantes=$solicitantes.', ';
            $trabajador=TableRegistry::get('Trabajadores')->get($solicitante->trabajador_id);
            $solicitantes=$solicitantes.$trabajador->nombre.' '.$trabajador->apellido;
        }
        return $solicitantes;
    }
    protected function _getSolicitanteid()
    {
        $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
            ->where(['proceso_id ='=>$this->_properties['id']])
            ->andWhere(['rol ='=>'Solicitante']);
        if($pro_tra==null||$pro_tra->isEmpty())
            return null;
        return $pro_tra->first()->trabajador_id;
    }
    protected function _getSupervisor()
    {
        $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
            ->where(['proceso_id ='=>$this->_properties['id']])
            ->andWhere(['rol ='=>'Supervisor']);
        if($pro_tra==null||$pro_tra->isEmpty())
            return 'Sin supervisor';
        $supervisores='';
        foreach ($pro_tra as $supervisor)
        {
            if($supervisores!='')
                $supervisores=$supervisores.', ';
            $trabajador=TableRegistry::get('Trabajadores')->get($supervisor->trabajador_id);
            $supervisores=$supervisores.$trabajador->nombre.' '.$trabajador->apellido;
        }
        return $supervisores;
    }
    protected function _getSupervisorid()
    {
        $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
            ->where(['proceso_id ='=>$this->_properties['id']])
            ->andWhere(['rol ='=>'Supervisor']);
        if($pro_tra==null||$pro_tra->isEmpty())
            return null;
        return $pro_tra->first()->trabajador_id;
    }

    protected function _setModified($value){
        if($this->fecha_de_aprobacion==''&&($this->estado=='Aprobado'||$this->estado=='Completado'))
            $this->fecha_de_aprobacion=$value;
        if($this->fecha_de_complecion==''&&$this->estado=='Completado')
            $this->fecha_de_complecion=$value;
        return $value;
    }

    protected function _setEstado($value)
    {
        if(($this->_properties['estado']=='Pendiente'||$this->_properties['estado']=='Aprobado')&&$value=='Completado')
        {
            $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
                ->where(['proceso_id ='=>$this->_properties['id']])
                ->andWhere(['rol ='=>'Solicitante']);
            if($pro_tra==null||$pro_tra->isEmpty())
                return $value;
            foreach ($pro_tra as $solicitante)
            {
                $trabajador=TableRegistry::get('Trabajadores')->get($solicitante->trabajador_id);
                if ($this->_properties['tipo'] != 'Devolucion')
                {
                    $asig = TableRegistry::get('Asignaciones')->find('all')
                    ->where(['proceso_id =' => $this->_properties['id']]);
                    if($trabajador->puesto_de_trabajo!=null&&($asig!=null&&!$asig->isEmpty()))
                        foreach ($asig as $a)
                        {
                            $articulo = TableRegistry::get('Articulos')->get($a->articulo_id);
                            $articulo->ubicacion = $trabajador->puesto_de_trabajo;
                            TableRegistry::get('Articulos')->save($articulo);
                        }
                }
                if ($this->_properties['tipo'] != 'Asignacion'){
                    $dev = TableRegistry::get('Devoluciones')->find('all')
                    ->where(['proceso_id =' => $this->_properties['id']]);
                    if($dev!=null&&!$dev->isEmpty())
                        foreach ($dev as $d)
                        {
                            $articulo = TableRegistry::get('Articulos')->get($d->articulo_id);
                            $articulo->ubicacion = 'Deposito IT';
                            TableRegistry::get('Articulos')->save($articulo);
                        }
                }
            }
            //eliminar asig-dev conflictos
            if ($this->_properties['tipo'] != 'Asignacion')
            {
                $dev = TableRegistry::get('Devoluciones')->find('all')
                    ->where(['proceso_id =' => $this->_properties['id']]);
                if($dev!=null&&!$dev->isEmpty())
                    foreach ($dev as $d)
                    {
                        $asig = TableRegistry::get('Asignaciones')->find('all')
                            ->where(['articulo_id =' => $d->articulo_id]);
                        if($asig!=null&&!$asig->isEmpty())
                            foreach ($asig as $a)
                            {
                                $a->hasta=date('Y-m-d',strtotime(date('Y-m-d') .' -1 day'));
                                TableRegistry::get('Asignaciones')->save($a);
                                //TableRegistry::get('Asignaciones')->delete($a);//si se prefiere eliminar.
                            }
                    }
            }

        }elseif($this->_properties['estado']!='Completado'&&$value=='Rechazado')
        {
            $asig=TableRegistry::get('Asignaciones')->find('all')
                ->where(['proceso_id ='=>$this->_properties['id']]);
            foreach ($asig as $nacion)
                TableRegistry::get('Asignaciones')->delete($nacion);
            $dev=TableRegistry::get('Devoluciones')->find('all')
                ->where(['proceso_id ='=>$this->_properties['id']]);
            foreach ($dev as $olucion)
                TableRegistry::get('Devoluciones')->delete($olucion);
        }

        return $value;
    }
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
