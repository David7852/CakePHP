<?php
namespace App\Model\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * Usuario Entity
 *
 * @property int $id
 * @property string $nombre_de_usuario
 * @property string $email
 * @property string $clave
 * @property string $funcion
 * @property string $pregunta
 * @property string $respuesta
 * @property int $trabajador_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Trabajador $trabajador
 */
class Usuario extends Entity
{
    protected function _setClave($value)
    {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($value);
    }
    protected function _setPregunta($value)
    {
        if($value==null)
            return $value;
        if($value[0]!='¿')
            $value='¿'.ucfirst($value);
        if($value[sizeof($value-1)]!='?')
            $value=$value.'?';
        return $value;
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
