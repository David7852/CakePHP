<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Accesorios Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Articulos
 *
 * @method \App\Model\Entity\Accesorio get($primaryKey, $options = [])
 * @method \App\Model\Entity\Accesorio newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Accesorio[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Accesorio|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Accesorio patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Accesorio[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Accesorio findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AccesoriosTable extends Table
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

        $this->table('accesorios');
        $this->displayField('titulo');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Articulos', [
            'foreignKey' => 'articulo_id'
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
            ->requirePresence('descripcion', 'create')
            ->notEmpty('descripcion');

        $validator
            ->allowEmpty('estado');

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
