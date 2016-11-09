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
 * @property \Cake\ORM\Association\HasMany $Facturas
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
        $this->displayField('numero');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Articulos', [
            'foreignKey' => 'articulo_id'
        ]);
        $this->hasMany('Facturas', [
            'foreignKey' => 'linea_id'
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
            ->requirePresence('operadora', 'create')
            ->notEmpty('operadora');

        $validator
            ->requirePresence('numero', 'create')
            ->notEmpty('numero');

        $validator
            ->integer('puk')
            ->allowEmpty('puk');

        $validator
            ->integer('pin')
            ->allowEmpty('pin');

        $validator
            ->allowEmpty('codigo_sim');

        $validator
            ->allowEmpty('estado');

        $validator
            ->allowEmpty('observaciones');

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
        $rules->add($rules->existsIn(['articulo_id'], 'Articulos'));

        return $rules;
    }
}
