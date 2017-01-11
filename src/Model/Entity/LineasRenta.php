<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LineasRenta Entity
 *
 * @property int $linea_id
 * @property int $renta_id
 *
 * @property \App\Model\Entity\Linea $linea
 * @property \App\Model\Entity\Renta $renta
 */
class LineasRenta extends Entity
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
        'linea_id' => true,
        'renta_id' => true
    ];
}
