<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Contrato Entity
 *
 * @property int $id
 * @property string $Titulo
 * @property int $Trabajador_id
 * @property \Cake\I18n\Time $Fecha_De_Inicio
 * @property \Cake\I18n\Time $Fecha_De_Culminacion
 * @property string $Tipo_De_Contrato
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Trabajador $trabajador
 */
class Contrato extends Entity
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
