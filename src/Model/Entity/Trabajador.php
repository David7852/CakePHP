<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Trabajador Entity
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property string $cedula
 * @property string $sexo
 * @property string $gerencia
 * @property string $cargo
 * @property int $sede
 * @property int $numero_de_oficina
 * @property string $telefono_personal
 * @property string $rif
 * @property string $residencia
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Contrato[] $contratos
 * @property \App\Model\Entity\Usuario[] $usuarios
 * @property \App\Model\Entity\Proceso[] $procesos
 */
class Trabajador extends Entity
{
    protected function _getTitulo()
    {
        return
            $this->_properties['nombre'] . ' ' . $this->_properties['apellido'];
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
