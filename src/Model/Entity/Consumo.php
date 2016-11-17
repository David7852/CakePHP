<?php
namespace App\Model\Entity;

use App\Controller\ConsumosController;
use Cake\ORM\Entity;

/**
 * Consumo Entity
 *
 * @property int $id
 * @property string $titulo
 * @property int $factura_id
 * @property int $renta_id
 * @property string $cupo
 * @property string $consumido
 * @property string $excedente
 * @property float $monto_bs
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Factura $factura
 * @property \App\Model\Entity\Renta $renta
 */
class Consumo extends Entity
{
    /**
     * @return string
     */
    protected function _getTitulo()
    {
        $c = new ConsumosController();
        $related=$c->getRelated($this->_properties['id']);
        return h($this->_properties['monto_bs']).' en la factura del '.h($related->factura->titulo);//titulo seria mejor en la forma : renta: monto_bs
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
