<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Asignacion Entity
 *
 * @property int $id
 * @property string $Titulo
 * @property int $Proceso_id
 * @property int $Articulo_id
 * @property \Cake\I18n\Time $Hasta
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Proceso $proceso
 * @property \App\Model\Entity\Articulo $articulo
 */
class Asignacion extends Entity
{

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
