<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use App\Controller\AccesoriosController;
/**
 * Accesorio Entity
 *
 * @property int $id
 * @property string $descripcion
 * @property string $estado
 * @property int $articulo_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Articulo $articulo
 */
class Accesorio extends Entity
{
    protected function _getTitulo()
    {
        $c = new AccesoriosController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return '';
        return h($this->_properties['descripcion']).' de '.h($related->articulo->titulo);
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
