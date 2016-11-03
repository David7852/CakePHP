<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Procesos Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Trabajors
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
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Trabajors', [
            'foreignKey' => 'trabajor_id',
            'joinType' => 'INNER'
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
            ->allowEmpty('Titulo');

        $validator
            ->allowEmpty('Motivo');

        $validator
            ->allowEmpty('Tipo');

        $validator
            ->date('Fecha_De_Solicitud')
            ->requirePresence('Fecha_De_Solicitud', 'create')
            ->notEmpty('Fecha_De_Solicitud');

        $validator
            ->date('Fecha_De_Aprobacion')
            ->allowEmpty('Fecha_De_Aprobacion');

        $validator
            ->allowEmpty('Estado');

        $validator
            ->allowEmpty('Observaciones');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['trabajor_id'], 'Trabajors'));

        return $rules;
    }
}
