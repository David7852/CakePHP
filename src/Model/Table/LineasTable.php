<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lineas Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Articulos
 * @property \Cake\ORM\Association\BelongsToMany $Rentas
 *
 * @method \App\Model\Entity\Linea get($primaryKey, $options = [])
 * @method \App\Model\Entity\Linea newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Linea[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Linea|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Linea patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Linea[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Linea findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LineasTable extends Table
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

        $this->table('lineas');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Articulos', [
            'foreignKey' => 'Articulo_id'
        ]);
        $this->belongsToMany('Rentas', [
            'foreignKey' => 'linea_id',
            'targetForeignKey' => 'renta_id',
            'joinTable' => 'lineas_rentas'
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
            ->requirePresence('Operadora', 'create')
            ->notEmpty('Operadora');

        $validator
            ->requirePresence('Numero', 'create')
            ->notEmpty('Numero');

        $validator
            ->integer('Puk')
            ->allowEmpty('Puk');

        $validator
            ->integer('Pin')
            ->allowEmpty('Pin');

        $validator
            ->allowEmpty('Codigo_Sim');

        $validator
            ->allowEmpty('Estado');

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
        $rules->add($rules->existsIn(['Articulo_id'], 'Articulos'));

        return $rules;
    }
}
