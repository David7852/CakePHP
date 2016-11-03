<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Consumos Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Facturas
 * @property \Cake\ORM\Association\BelongsTo $Rentas
 *
 * @method \App\Model\Entity\Consumo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Consumo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Consumo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Consumo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Consumo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Consumo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Consumo findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ConsumosTable extends Table
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

        $this->table('consumos');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Facturas', [
            'foreignKey' => 'Factura_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Rentas', [
            'foreignKey' => 'Renta_id',
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
            ->allowEmpty('Consumido');

        $validator
            ->allowEmpty('Excedente');

        $validator
            ->numeric('Monto_Bs')
            ->requirePresence('Monto_Bs', 'create')
            ->notEmpty('Monto_Bs');

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
        $rules->add($rules->existsIn(['Factura_id'], 'Facturas'));
        $rules->add($rules->existsIn(['Renta_id'], 'Rentas'));

        return $rules;
    }
}
