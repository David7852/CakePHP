<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Rentas Model
 *
 * @property \Cake\ORM\Association\HasMany $Consumos
 * @property \Cake\ORM\Association\BelongsToMany $Lineas
 *
 * @method \App\Model\Entity\Renta get($primaryKey, $options = [])
 * @method \App\Model\Entity\Renta newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Renta[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Renta|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Renta patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Renta[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Renta findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RentasTable extends Table
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

        $this->table('rentas');
        $this->displayField('nombre');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Servicios', [
            'foreignKey' => 'renta_id'
        ]);
        $this->belongsToMany('Lineas', [
            'foreignKey' => 'renta_id',
            'targetForeignKey' => 'linea_id',
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
            ->requirePresence('nombre', 'create')
            ->notEmpty('nombre');

        $validator
            ->numeric('monto_basico')
            ->allowEmpty('monto_basico');

        $validator
            ->allowEmpty('operadora');

        return $validator;
    }
}
