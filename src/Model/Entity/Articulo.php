<?php
namespace App\Model\Entity;

use App\Model\Table\ArticulosTable;
use App\Model\Table\ModelosTable;
use Cake\ORM\Entity;

/**
 * Articulo Entity
 *
 * @property int $id
 * @property string $serial
 * @property int $modelo_id
 * @property string $datos
 * @property string $ubicacion
 * @property string $estado
 * @property \Cake\I18n\Time $fecha_de_compra
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Modelo $modelo
 * @property \App\Model\Entity\Accesorio[] $accesorios
 * @property \App\Model\Entity\Asignacion[] $asignaciones
 * @property \App\Model\Entity\Devolucion[] $devoluciones
 * @property \App\Model\Entity\Linea[] $lineas
 */
class Articulo extends Entity
{
    protected function _getTitulo()
    {
        return $this->_properties['serial'];//mas titulo de modelo
    }//ubicacion deberia tener un metodo set o get tal que cuando se asigne un articulo a alguien cambie a la ubicacion de la persona.

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
