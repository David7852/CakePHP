<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Facturas Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Lineas
 * @property \Cake\ORM\Association\HasMany $Consumos
 *
 * @method \App\Model\Entity\Factura get($primaryKey, $options = [])
 * @method \App\Model\Entity\Factura newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Factura[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Factura|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Factura patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Factura[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Factura findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FacturasTable extends Table
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

        $this->table('facturas');
        $this->displayField('titulo');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Lineas', [
            'foreignKey' => 'linea_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Consumos', [
            'foreignKey' => 'factura_id'
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
            ->date('paguese_antes_de')
            ->allowEmpty('paguese_antes_de');

        $validator
            ->numeric('balance')
            ->requirePresence('balance', 'create')
            ->notEmpty('balance');

        $validator
            ->date('desde')
            ->requirePresence('desde', 'create')
            ->notEmpty('desde');

        $validator
            ->date('hasta')
            ->requirePresence('hasta', 'create')
            ->notEmpty('hasta');

        $validator
            ->allowEmpty('numero_de_cuenta');

        $validator
            ->allowEmpty('iva');

        $validator
            ->allowEmpty('cargos_extra');

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
        $rules->add($rules->existsIn(['linea_id'], 'Lineas'));
        return $rules;
    }
}
