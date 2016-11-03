<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Factura Entity
 *
 * @property int $id
 * @property string $Titulo
 * @property int $Linea_id
 * @property \Cake\I18n\Time $Paguese_Antes_De
 * @property float $Balance
 * @property \Cake\I18n\Time $Desde
 * @property \Cake\I18n\Time $Hasta
 * @property string $Numero_De_Cuenta
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Linea $linea
 */
class Factura extends Entity
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
