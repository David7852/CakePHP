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
    protected function _getModeloent(){
        $c = new ArticulosController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return '';
        if ( $related->modelo!=null)
            return $related->modelo;
        return null;
    }
    protected function _getAccesorioent(){
        $acc=TableRegistry::get('Accesorios')->find('all')
            ->where(['articulo_id ='=>$this->_properties['id']]);
        foreach ($acc as $a)
            return $a;
        return null;
    }
    protected function _getImagen(){
        $c = new ArticulosController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return '';
        if ( $related->modelo->imagen!=null)
            return $related->modelo->imagen;
        return 'no disponible.png';
    }

    protected function _getTitulo()
    {
        $c = new ArticulosController();
        $related=$c->getRelated($this->_properties['id']);
        if($related==null)
            return '';
        $tit=h($related->modelo->tipo).", S/N: ".$this->_properties['serial'];
        if( $related->modelo->tipo_de_articulo=='Celular'||$related->modelo->tipo_de_articulo=='Telefono' || $related->modelo->tipo_de_articulo=='Smartphone')
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

    protected function _getAsignadoid()
    {
        $solicitantes=array();
        $asig=TableRegistry::get('Asignaciones')->find('all')
            ->where(['articulo_id ='=>$this->_properties['id']])
            ->andWhere(['hasta >='=>date('Y-m-d')]);
        foreach ($asig as $naciones)
        {
            $pro=TableRegistry::get('Procesos')->find('all')
                ->where(['id ='=>$naciones->proceso_id])
                ->andWhere(['estado ='=>'Completado']);
            foreach ($pro as $cesos )
            {
                $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
                    ->where(['proceso_id ='=>$cesos->id])
                    ->andWhere(['rol ='=>'Solicitante']);
                foreach ($pro_tra as $tra)
                    array_push($solicitantes,$tra->trabajador_id);
            }
        }
        if(!empty($solicitantes))
            return $solicitantes[0];
        return '';
    }
    protected function _getAsignado()
    {
        $asig=TableRegistry::get('Asignaciones')->find('all')
            ->where(['articulo_id ='=>$this->_properties['id']])
            ->andWhere(['hasta >='=>date('Y-m-d')]);
        foreach ($asig as $naciones)
        {
            $pro=TableRegistry::get('Procesos')->find('all')
                ->where(['id ='=>$naciones->proceso_id])
                ->andWhere(['estado ='=>'Completado']);
            foreach ($pro as $cesos )
            {
                $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
                    ->where(['proceso_id ='=>$cesos->id])
                    ->andWhere(['rol ='=>'Solicitante']);
                foreach ($pro_tra as $tra)
                {
                    $trabajador=TableRegistry::get('Trabajadores')->get($tra->trabajador_id);
                    return $trabajador->nombre.' '.$trabajador->apellido;
                }
            }
        }
        return '';
    }
    protected function _getAsignadoent()
    {
        $asig=TableRegistry::get('Asignaciones')->find('all')
            ->where(['articulo_id ='=>$this->_properties['id']])
            ->andWhere(['hasta >='=>date('Y-m-d')]);
        foreach ($asig as $naciones)
        {
            $pro=TableRegistry::get('Procesos')->find('all')
                ->where(['id ='=>$naciones->proceso_id])
                ->andWhere(['estado ='=>'Completado']);
            foreach ($pro as $cesos )
            {
                $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
                    ->where(['proceso_id ='=>$cesos->id])
                    ->andWhere(['rol ='=>'Solicitante']);
                foreach ($pro_tra as $tra)
                {
                    $trabajador=TableRegistry::get('Trabajadores')->get($tra->trabajador_id);
                    return $trabajador;
                }
            }
        }
        return '';
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
