<?php
namespace App\Model\Entity;

use App\Controller\FacturasController;
use Cake\ORM\Entity;

/**
 * Factura Entity
 *
 * @property int $id
 * @property int $linea_id
 * @property \Cake\I18n\Time $paguese_antes_de
 * @property float $balance
 * @property float $iva
 * @property float $cargos_extra
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
    protected function _getLineano()
    {
        $c = new FacturasController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return '';
        return $related->linea->numero;
    }
    protected function _getLinealt()
    {
        $c = new FacturasController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return '';
        if($related->linea!=null)
            return $related->linea;
        return null;
    }
    protected function _getBalance($balance)
    {/*
        if($balance!==null){
            if($this->_properties['id']===null||$this->_properties['balance']===null)
                return 0;
            if($this->_properties['balance']!=0)
                return $this->_properties['balance'];
            $b=0;
            $c = new FacturasController();
            $related=$c->getRelated($this->_properties['id']);
            if($related==null)
                return 0;
            $rentas=$related->linea->rentasalt;
            if($rentas!=null)
                foreach ($rentas as $renta)
                    $b=$b+$renta->monto_basico;
            $consumos=$related->consumos;
            if($consumos!=null)
                foreach ($consumos as $consumo)
                    $b=$b+$consumo->monto_bs;
            return $b+$this->_properties['cargos_extra'];
        }*/
        if($balance==0&&$balance!==null)
        {
            if($this->_properties['balance']!=0)
                return $this->_properties['balance'];
            $b=0;
            $c = new FacturasController();
            if($this->id!=null);
                $related=$c->getRelated($this->id);
            if($related==null)
                return 0;
            $rentas=$related->linea->rentasalt;
            if($rentas!=null)
                foreach ($rentas as $renta)
                    $b=$b+$renta->monto_basico;
            $consumos=$related->consumos;
            if($consumos!=null)
                foreach ($consumos as $consumo)
                    $b=$b+$consumo->monto_bs;
            return $b+$this->_properties['cargos_extra'];
        }return $balance;
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
