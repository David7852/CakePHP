<?php
namespace App\Model\Entity;

use App\Controller\LineasController;
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
    protected function _getTitulo()
    {
        $c = new LineasController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return '';
        if($related->articulo!=null&&$related->articulo->asignado!='')
            return 'Linea de '.$related->articulo->asignado;
        return 'Linea sin asignar';
    }
    protected function _getRentasalt()
    {
        $c = new LineasController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return null;
        if(!empty($related->rentas))
            return $related->rentas;
        return null;
    }
    protected function _getPropietarioent()
    {
        $c = new LineasController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return '';
        if($related->articulo!=null)
            return $related->articulo->asignadoent;
        return 'Sin propietario';
    }
    protected function _getPropietario()
    {
        $c = new LineasController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return '';
        if($related->articulo!=null)
            return $related->articulo->asignado;
        return 'Sin propietario';
    }
    protected function _getPropietarioid()
    {
        $c = new LineasController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return '';
        if($related->articulo!=null)
            return $related->articulo->asignadoid;
        return '';
    }
    protected function _getAltarticulo()
    {
        $c = new LineasController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return null;
        return $related->articulo;
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
