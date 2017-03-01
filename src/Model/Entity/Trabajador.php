<?php
namespace App\Model\Entity;

use App\Controller\TrabajadoresController;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
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
 * @property string $extension
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
    protected function _getLineano()
    {
        $lineas=TableRegistry::get('Lineas')->find('all')->where(['estado ='=>'Activa']);
        foreach ($lineas as $linea)
        {
            if($linea->propietarioid==$this->_properties['id'])
                return $linea->numero;
        }
        return 'Sin asignar';
    }

    protected function _setPuesto_de_trabajo($value)
    {
        $pro_tra=TableRegistry::get('ProcesosTrabajadores')->find('all')
            ->where(['trabajador_id =' => $this->_properties['id']])
            ->andWhere(['rol ='=>'Solicitante']);
        foreach ($pro_tra as $pt)
        {
            $proceso=TableRegistry::get('Procesos')->find('all')
                ->where(['id ='=>$pt->proceso_id])
                ->andWhere(['estado ='=>'Completado']);
            foreach ($proceso as $p)
            {
                $asig = TableRegistry::get('Asignaciones')->find('all')
                    ->where(['proceso_id =' => $p->id])
                    ->andWhere(['hasta >='=>date('Y-m-d')]);
                foreach ($asig as $a)
                {
                    $articulo = TableRegistry::get('Articulos')->get($a->articulo_id);
                    $articulo->ubicacion = $value;
                    TableRegistry::get('Articulos')->save($articulo);
                }
            }
        }
        return $value;
    }
    protected function _getemail()
    {
        $users=TableRegistry::get('Usuarios')->find('all')
            ->where(['trabajador_id ='=>$this->_properties['id']]);
        foreach ($users as $user)
            return $user->email;
        return null;
    }
    protected function _getSupervisor()
    {
        if($this->_properties['cargo']=='Gerente')
            return $this;
        $company=TableRegistry::get('Trabajadores')->find('all')
            ->where(['Gerencia ='=>$this->_properties['gerencia']]);
        foreach ($company as $tr)
        {
            if($tr->area==$this->_properties['area']&&$tr->cargo=='Supervisor'||$tr->cargo=='Superintendente')
                return $tr;
        }
        foreach ($company as $tr)
        {
            if($tr->cargo=='Supervisor'||$tr->cargo=='Superintendente')
                return $tr;
        }
        foreach ($company as $tr)
        {
            if($tr->cargo=='Gerente')
                return $tr;
        }
        return null;
    }

    protected function _getCargofix()
    {
        if($this->_properties['sexo']=='F')
        {
        switch ($this->_properties['cargo']) {
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
                return $this->_properties['cargo'];}
        }
        return $this->_properties['cargo'];
    }
    //Methods for set gerencia and set cargo should be created aswell
    protected function _getTitulo()
    {
        return $this->_properties['nombre'] . ' ' . $this->_properties['apellido'];
    }
    protected function _getPuesto()
    {
        if($this->_properties['area']!='')
            return $this->_getCargofix().' de '.$this->_properties['area'];
        return $this->_getCargofix();
    }
    protected function _getCargogerencial()
    {
        return $this->_getCargofix().' de '.$this->_properties['gerencia'];
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
