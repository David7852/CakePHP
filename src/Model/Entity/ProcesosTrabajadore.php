<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProcesosTrabajadore Entity
 *
 * @property int $trabajador_id
 * @property int $proceso_id
 * @property string $rol
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
        'trabajador_id' => true,
        'proceso_id' => true
    ];
}
