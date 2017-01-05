<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;


/**
 * Proceso Entity
 *
 * @property int $id
 * @property string $titulo
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
    protected function _getTitulo()
    {
        return $this->_properties['titulo'];
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
