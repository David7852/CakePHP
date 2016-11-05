<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProcesosTrabajadore Entity
 *
 * @property int $Trabajador_id
 * @property int $Proceso_id
 * @property string $Rol
 *
 * @property \App\Model\Entity\Trabajador $trabajador
 * @property \App\Model\Entity\Proceso $proceso
 */
class ProcesosTrabajadore extends Entity
{

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
        'Trabajador_id' => false,
        'Proceso_id' => false
    ];
}
