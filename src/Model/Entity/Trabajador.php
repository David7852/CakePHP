<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Trabajador Entity
 *
 * @property int $id
 * @property string $Nombre
 * @property string $Apellido
 * @property string $Cedula
 * @property string $Gerencia
 * @property string $Cargo
 * @property int $Sede
 * @property int $Numero_De_Oficina
 * @property string $Telefono_Personal
 * @property string $Rif
 * @property string $Residencia
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Contrato[] $contratos
 * @property \App\Model\Entity\Proceso[] $procesos
 * @property \App\Model\Entity\Usuario[] $usuarios
 */
class Trabajador extends Entity
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
