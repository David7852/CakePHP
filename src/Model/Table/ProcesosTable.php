<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Procesos Model
 *
 * @property \Cake\ORM\Association\HasMany $Asignaciones
 * @property \Cake\ORM\Association\HasMany $Devoluciones
 * @property \Cake\ORM\Association\BelongsToMany $Trabajadores
 *
 * @method \App\Model\Entity\Proceso get($primaryKey, $options = [])
 * @method \App\Model\Entity\Proceso newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Proceso[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Proceso|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Proceso patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Proceso[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Proceso findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProcesosTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('procesos');
        $this->displayField('motivo');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Asignaciones', [
            'foreignKey' => 'proceso_id'
        ]);
        $this->hasMany('Devoluciones', [
            'foreignKey' => 'proceso_id'
        ]);
        $this->belongsToMany('Trabajadores', [
            'foreignKey' => 'proceso_id',
            'targetForeignKey' => 'trabajador_id',
            'joinTable' => 'procesos_trabajadores'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('motivo', 'create')
            ->notEmpty('motivo');

        $validator
            ->requirePresence('tipo', 'create')
            ->notEmpty('tipo');

        $validator
            ->date('fecha_de_aprobacion')
            ->allowEmpty('fecha_de_aprobacion');

        $validator
            ->date('fecha_de_complecion')
            ->allowEmpty('fecha_de_complecion');

        $validator
            ->allowEmpty('estado');

        $validator
            ->allowEmpty('observaciones');

        return $validator;
    }
}
