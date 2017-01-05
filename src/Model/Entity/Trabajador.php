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
 * @property string $area
 * @property int $sede
 * @property string $puesto_de_trabajo
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
    protected function _setNombre($value)
    {
        return trim($value);
    }
    protected function _setApellido($value)
    {
        return trim($value);
    }
    protected function _setCargo($value)
    {
        if($this->_properties['sexo']=='F')
        {
        switch ($value) {
            case "Supervisor":
                return "Supervisora";
            case "Jefe de planta":
                return "Jefa de planta";
            case "Secretario":
                return "Secretaria";
            case "Consultor":
                return "Consultora";
            case "Consejero":
                return "Consejera";
            default:
                return $value;}
        }
        return $value;
    }
    //Methods for set gerencia and set cargo should be created aswell
    protected function _getTitulo()
    {
        return $this->_properties['nombre'] . ' ' . $this->_properties['apellido'];
    }
    protected function _getPuesto()
    {
        if($this->_properties['area']!='')
            return $this->_properties['cargo'].' de '.$this->_properties['area'];
        return $this->_properties['cargo'];
    }
    protected function _getCargogerencial()
    {
        return $this->_properties['cargo'].' de '.$this->_properties['gerencia'];
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
