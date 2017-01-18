<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use App\Controller\ArticulosController;
use Cake\ORM\TableRegistry;
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
        $c = new ArticulosController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return '';
        $tit=h($related->modelo->tipo).", S/N: ".$this->_properties['serial'];
        if( strcasecmp ( $related->modelo->tipo_de_articulo ,'Celular' )||strcasecmp ( $related->modelo->tipo_de_articulo ,'Telefono' )||strcasecmp ( $related->modelo->tipo_de_articulo ,'Smartphone' ))
        {
           $l='';
           $asig_lineas=TableRegistry::get('Lineas')->find('all')->where(['articulo_id ='=>$this->_properties['id']]);
           if($asig_lineas->isEmpty())
               return $tit.' (Sin linea asignada)';
           foreach ($asig_lineas as $linea)
           {
               if($l!='')
                   $l=$l.',';
               $l=$l.' ('.$linea->numero.')';
           }
           return $tit.' '.$l;
        }
        return  $tit;
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
