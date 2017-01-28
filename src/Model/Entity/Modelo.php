<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Modelo Entity
 *
 * @property int $id
 * @property string $marca
 * @property string $modelo
 * @property string $tipo_de_articulo
 * @property string $serial_comun
 * @property string $imagen
 * @property string $abstracto
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Articulo[] $articulos
 */
class Modelo extends Entity
{
    protected function _getTitulo()
    {
        return $this->_properties['tipo_de_articulo']. ' ' . $this->_properties['marca'] . ', ' . $this->_properties['modelo'];
    }
    protected function _getTipo()
    {
        return $this->_properties['tipo_de_articulo']. ' ' . $this->_properties['marca'];
    }
    protected function _getMarcamodelo()
    {
        return $this->_properties['marca'] . ', ' . $this->_properties['modelo'];
    }
    protected function _getImagen()
    {
        if(empty($this->_properties)||$this->_properties['imagen']==''||$this->_properties['imagen']==null)
            return  'no disponible.png';
        return $this->_properties['imagen'];
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
