<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use App\Controller\DevolucionesController;
/**
 * Devolucion Entity
 *
 * @property int $id
 * @property int $proceso_id
 * @property int $articulo_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Proceso $proceso
 * @property \App\Model\Entity\Articulo $articulo
 */
class Devolucion extends Entity
{
    protected function _getArticuloent()
    {
        $c = new DevolucionesController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return ' ';
        if ( $related->articulo!=null)
            return $related->articulo;
        return null;
    }
    protected function _getArt()
    {
        $c = new DevolucionesController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return '';
        return h($related->articulo->titulo);
    }
    protected function _getEstado()
    {
        $c = new DevolucionesController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return '';
        return h($related->proceso->estado);
    }
    protected function _getTitulo()
    {
        $c = new DevolucionesController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return '';
        if($related->proceso->estado!='Aprobado')
            return 'Devolucion de '.$related->articulo->titulo.  h($related->proceso->estado);
        return 'Devolucion de '.$related->articulo->titulo;
        //return 'Devolucion del'.$this->articulo->titulo. h($related->proceso->estado); //nombre del trabajador con el proceso_trabajador rol solicitante
    }
    protected function _getAltproceso()
    {
        $c = new DevolucionesController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return null;
        return $related->proceso;
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
