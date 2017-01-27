<?php
namespace App\Model\Entity;

use App\Controller\ConsumosController;
use Cake\ORM\Entity;

/**
 * Consumo Entity
 *
 * @property int $id
 * @property int $factura_id
 * @property int $servicio_id
 * @property string $consumido
 * @property string $excedente
 * @property float $monto_bs
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Factura $factura
 * @property \App\Model\Entity\Servicio $servicio
 */
class Consumo extends Entity
{

    protected function _getCupo()
    {
        $c = new ConsumosController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return '';
        return $related->servicio->cupo;
    }
    protected function _getFacturatitulo()
    {
        $c = new ConsumosController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return '';
        return $related->factura->titulo;
    }
    /**
     * @return string
     */
    protected function _getTitulo()
    {
        $c = new ConsumosController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return '';
        return h($this->_properties['monto_bs']).' en la factura del '.h($related->factura->titulo);
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
