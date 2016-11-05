<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProcesosTrabajadores Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Trabajadores
 * @property \Cake\ORM\Association\BelongsTo $Procesos
 *
 * @method \App\Model\Entity\ProcesosTrabajadore get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProcesosTrabajadore newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProcesosTrabajadore[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProcesosTrabajadore|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProcesosTrabajadore patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProcesosTrabajadore[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProcesosTrabajadore findOrCreate($search, callable $callback = null)
 */
class ProcesosTrabajadoresTable extends Table
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

        $this->table('procesos_trabajadores');
        $this->displayField('Trabajador_id');
        $this->primaryKey(['Trabajador_id', 'Proceso_id']);

        $this->belongsTo('Trabajadores', [
            'foreignKey' => 'Trabajador_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Procesos', [
            'foreignKey' => 'Proceso_id',
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
            ->allowEmpty('Rol');

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
        $rules->add($rules->existsIn(['Trabajador_id'], 'Trabajadores'));
        $rules->add($rules->existsIn(['Proceso_id'], 'Procesos'));

        return $rules;
    }
}
