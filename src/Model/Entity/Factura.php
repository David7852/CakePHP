<?php
namespace App\Model\Entity;

use App\Controller\FacturasController;
use App\Model\Table\FacturasTable;
use Cake\ORM\Entity;

/**
 * Factura Entity
 *
 * @property int $id
 * @property int $linea_id
 * @property \Cake\I18n\Time $paguese_antes_de
 * @property float $balance
 * @property \Cake\I18n\Time $desde
 * @property \Cake\I18n\Time $hasta
 * @property string $numero_de_cuenta
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Linea $linea
 * @property \App\Model\Entity\Consumo[] $consumos
 */
class Factura extends Entity
{
    protected function _getTitulo()
    {
        $c = new FacturasController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return '';
        return h($related->linea->numero.' ('.$this->_properties['desde'].')');
    }

    protected function _getBalance()
    {
        $b=0;
        $c = new FacturasController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return 0;
        foreach ($related->consumos as $consumo)
        {
            $b=$b+$consumo->monto_bs;
        }
        return $b;
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
