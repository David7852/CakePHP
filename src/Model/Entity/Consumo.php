<?php
namespace App\Model\Entity;

use App\Controller\ConsumosController;
use Cake\ORM\Entity;

class Consumo extends Entity
{
    protected function _getServicionombre()    {
        $c = new ConsumosController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return '';
        return $related->servicio->nombre;
    }
    protected function _getCupo()    {
        $c = new ConsumosController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return '';
        return $related->servicio->cupo;
    }
    protected function _getFacturatitulo()    {
        $c = new ConsumosController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return '';
        return $related->factura->titulo;
    }
    protected function _getFecha()
    {
        $c = new ConsumosController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return '';
        return $related->factura->desde;
    }
    protected function _getLinea()
    {
        $c = new ConsumosController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return '';
        return $related->factura->lineano;
    }
    protected function _getTitulo()    {//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $c = new ConsumosController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return '';
        return h($this->_properties['monto_bs']).' Bs. en factura del '.h($related->factura->titulo);
    }
    protected function _getDetalle()    {//!!!!!!!!!!!!!!!!!!!!!!!
        $c = new ConsumosController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return '';
        return h($this->_properties['monto_bs']).' Bs. '.h($related->servicio->titulo);
    }
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
