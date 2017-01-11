<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Articulos Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Modelos
 * @property \Cake\ORM\Association\HasMany $Accesorios
 * @property \Cake\ORM\Association\HasMany $Asignaciones
 * @property \Cake\ORM\Association\HasMany $Devoluciones
 * @property \Cake\ORM\Association\HasMany $Lineas
 *
 * @method \App\Model\Entity\Articulo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Articulo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Articulo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Articulo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Articulo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Articulo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Articulo findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ArticulosTable extends Table
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

        $this->table('articulos');
        $this->displayField('titulo');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Modelos', [
            'foreignKey' => 'modelo_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Accesorios', [
            'foreignKey' => 'articulo_id'
        ]);
        $this->hasMany('Asignaciones', [
            'foreignKey' => 'articulo_id'
        ]);
        $this->hasMany('Devoluciones', [
            'foreignKey' => 'articulo_id'
        ]);
        $this->hasMany('Lineas', [
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
            ->requirePresence('serial', 'create')
            ->notEmpty('serial')
            ->add('serial', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);
        $validator
            ->allowEmpty('datos');
        $validator
            ->allowEmpty('ubicacion');
        $validator
            ->allowEmpty('estado');
        $validator
            ->date('fecha_de_compra')
            ->allowEmpty('fecha_de_compra');

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
        $rules->add($rules->isUnique(['serial']));
        $rules->add($rules->existsIn(['modelo_id'], 'Modelos'));

        return $rules;
    }
}
