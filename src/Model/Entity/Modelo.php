<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Modelo Entity
 *
 * @property int $id
 * @property string $Marca
 * @property string $Modelo
 * @property string $Tipo_De_Articulo
 * @property string $Serial_Comun
 * @property string $Imagen
 * @property string $Abstracto
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Modelo extends Entity
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
