<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Consumo Entity
 *
 * @property int $id
 * @property string $Titulo
 * @property int $Factura_id
 * @property int $Renta_id
 * @property string $Consumido
 * @property string $Excedente
 * @property float $Monto_Bs
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Factura $factura
 * @property \App\Model\Entity\Renta $renta
 */
class Consumo extends Entity
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
