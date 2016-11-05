<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Linea Entity
 *
 * @property int $id
 * @property string $operadora
 * @property string $numero
 * @property int $puk
 * @property int $pin
 * @property string $codigo_sim
 * @property int $articulo_id
 * @property string $estado
 * @property string $observaciones
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Articulo $articulo
 * @property \App\Model\Entity\Factura[] $facturas
 * @property \App\Model\Entity\Renta[] $rentas
 */
class Linea extends Entity
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
