<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Devoluciones Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Procesos
 * @property \Cake\ORM\Association\BelongsTo $Articulos
 *
 * @method \App\Model\Entity\Devolucion get($primaryKey, $options = [])
 * @method \App\Model\Entity\Devolucion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Devolucion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Devolucion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Devolucion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Devolucion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Devolucion findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DevolucionesTable extends Table
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

        $this->table('devoluciones');
        $this->displayField('titulo');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Procesos', [
            'foreignKey' => 'proceso_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Articulos', [
            'foreignKey' => 'articulo_id',
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
        $rules->add($rules->existsIn(['proceso_id'], 'Procesos'));
        $rules->add($rules->existsIn(['articulo_id'], 'Articulos'));

        return $rules;
    }
}
