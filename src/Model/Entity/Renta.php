<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Renta Entity
 *
 * @property int $id
 * @property string $nombre
 * @property float $monto_basico
 * @property string $operadora
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Consumo[] $consumos
 * @property \App\Model\Entity\Linea[] $lineas
 */
class Renta extends Entity
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
        'id' => false
    ];
}
