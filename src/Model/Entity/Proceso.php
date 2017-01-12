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
    protected function _setModified($value){
        if($this->fecha_de_aprobacion==''&&($this->estado=='Aprobado'||$this->estado=='Completado'))
            $this->fecha_de_aprobacion=$value;
        return $value;
    }
    protected function _setEstado($value)
    {
        if(($this->_properties['estado']=='Pendiente'||$this->_properties['estado']=='Aprobado')&&$value=='Completado')
        {
            $c = new ProcesosController();
            $related=$c->getRelated($this->_properties['id']);
            if($related==null)
                return $value;
            $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
                ->where(['proceso_id ='=>$this->_properties['id']])
                ->andWhere(['rol ='=>'Solicitante']);
            if($pro_tra==null||$pro_tra->isEmpty())
                return $value;
            foreach ($pro_tra as $solicitante)
            {
                $trabajador=TableRegistry::get('Trabajador')->get($solicitante->trabajador_id);
                if ($related->proceso->tipo != 'Devolucion')
                {
                    $asig = TableRegistry::get('Asignaciones')->find('all')
                    ->where(['proceso_id =' => $solicitante->proceso_id]);
                    if($trabajador->puesto_de_trabajo!=null&&($asig!=null&&!$asig->isEmpty()))
                        foreach ($asig as $a)
                        {
                            $articulo = TableRegistry::get('Articulos')->get($a->articulo_id);
                            $articulo->ubicacion = $trabajador->puesto_de_trabajo;
                        }
                }
                if ($related->proceso->tipo != 'Asignacion'){
                    $dev = TableRegistry::get('Devolucion')->find('all')
                    ->where(['proceso_id =' => $solicitante->proceso_id]);
                    if($dev!=null&&!$dev->isEmpty())
                        foreach ($dev as $d)
                        {
                            $articulo = TableRegistry::get('Articulos')->get($d->articulo_id);
                            $articulo->ubicacion = 'Deposito IT';
                        }
                }
            }
        }/*else
            if($this->_properties['estado']=='Pendiente'&&$value=='Aprobado'){

            }*/
        return $value;
    }
    protected function _getTitulo()
    {
        return $this->_properties['tipo']." ".$this->_properties['estado'];
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
