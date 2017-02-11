<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\Localized\Validation\FrValidation;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Trabajadores Model
 *
 * @property \Cake\ORM\Association\HasMany $Contratos
 * @property \Cake\ORM\Association\HasMany $Usuarios
 * @property \Cake\ORM\Association\BelongsToMany $Procesos
 *
 * @method \App\Model\Entity\Trabajador get($primaryKey, $options = [])
 * @method \App\Model\Entity\Trabajador newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Trabajador[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Trabajador|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Trabajador patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Trabajador[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Trabajador findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TrabajadoresTable extends Table
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

        $this->table('trabajadores');
        $this->displayField('titulo');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Contratos', [
            'foreignKey' => 'trabajador_id'
        ]);
        $this->hasMany('Usuarios', [
            'foreignKey' => 'trabajador_id'
        ]);
        $this->belongsToMany('Procesos', [
            'foreignKey' => 'trabajador_id',
            'targetForeignKey' => 'proceso_id',
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
            ->requirePresence('nombre', 'create')
            ->notEmpty('nombre')
            ->minLength('nombre',2);

        $validator
            ->requirePresence('apellido', 'create')
            ->notEmpty('apellido')
            ->minLength('apellido',2);

        $validator
            ->requirePresence('cedula', 'create')
            ->nonNegativeInteger('cedula')
            ->minLength('cedula',7)
            ->notEmpty('cedula')
            ->add('cedula', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->allowEmpty('sexo');

        $validator
            ->requirePresence('gerencia', 'create')
            ->notEmpty('gerencia');

        $validator
            ->requirePresence('cargo', 'create')
            ->notEmpty('cargo');

        $validator
            ->allowEmpty('area');

        $validator
            ->integer('sede')
            ->allowEmpty('sede');

        $validator
            ->allowEmpty('puesto_de_trabajo');

        $validator
            ->allowEmpty('extension');

        $validator
            ->allowEmpty('telefono_personal');

        $validator
            ->allowEmpty('rif');

        $validator
            ->allowEmpty('residencia');

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
        $rules->add($rules->isUnique(['cedula']));

        return $rules;
    }
}
