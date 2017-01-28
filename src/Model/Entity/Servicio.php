<?php
namespace App\Model\Entity;

use App\Controller\ServiciosController;
use Cake\ORM\Entity;

/**
 * Servicio Entity
 *
 * @property int $id
 * @property string $nombre
 * @property string $cupo
 * @property int $renta_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Renta $renta
 * @property \App\Model\Entity\Consumo[] $consumos
 */
class Servicio extends Entity
{//titulo seria la renta asociada mas el nombre

    protected function _getTitulo()
    {
        $c = new ServiciosController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return '';
        return $this->_properties['nombre'].' de '.$related->renta->nombre;
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
