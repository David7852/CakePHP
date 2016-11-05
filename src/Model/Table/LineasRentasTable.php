<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LineasRentas Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Lineas
 * @property \Cake\ORM\Association\BelongsTo $Rentas
 *
 * @method \App\Model\Entity\LineasRenta get($primaryKey, $options = [])
 * @method \App\Model\Entity\LineasRenta newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\LineasRenta[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LineasRenta|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LineasRenta patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LineasRenta[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\LineasRenta findOrCreate($search, callable $callback = null)
 */
class LineasRentasTable extends Table
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

        $this->table('lineas_rentas');
        $this->displayField('linea_id');
        $this->primaryKey(['linea_id', 'renta_id']);

        $this->belongsTo('Lineas', [
            'foreignKey' => 'linea_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Rentas', [
            'foreignKey' => 'renta_id',
            'joinType' => 'INNER'
        ]);
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
        $rules->add($rules->existsIn(['renta_id'], 'Rentas'));

        return $rules;
    }
}
