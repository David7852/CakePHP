<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Linea Entity
 *
 * @property int $id
 * @property string $Operadora
 * @property string $Numero
 * @property int $Puk
 * @property int $Pin
 * @property string $Codigo_Sim
 * @property int $Articulo_id
 * @property string $Estado
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Articulo $articulo
 * @property \App\Model\Entity\Renta[] $rentas
 */
class Linea extends Entity
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
