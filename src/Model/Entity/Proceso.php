<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Proceso Entity
 *
 * @property int $id
 * @property string $Titulo
 * @property int $trabajor_id
 * @property string $Motivo
 * @property string $Tipo
 * @property \Cake\I18n\Time $Fecha_De_Solicitud
 * @property \Cake\I18n\Time $Fecha_De_Aprobacion
 * @property string $Estado
 * @property string $Observaciones
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Trabajor $trabajor
 */
class Proceso extends Entity
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
