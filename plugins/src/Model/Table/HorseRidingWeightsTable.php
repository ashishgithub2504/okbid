<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HorseRidingWeights Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Horses
 *
 * @method \App\Model\Entity\HorseRidingWeight get($primaryKey, $options = [])
 * @method \App\Model\Entity\HorseRidingWeight newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\HorseRidingWeight[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HorseRidingWeight|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HorseRidingWeight patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HorseRidingWeight[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\HorseRidingWeight findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class HorseRidingWeightsTable extends Table
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

        $this->table('horse_riding_weights');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Horses', [
            'foreignKey' => 'horse_id',
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

//        $validator
//            ->integer('riding_type')
//            ->allowEmpty('riding_type');
//
//        $validator
//            ->integer('before_weight')
//            ->allowEmpty('before_weight');
//
//        $validator
//            ->integer('after_weight')
//            ->allowEmpty('after_weight');
//
//        $validator
//            ->date('weight_date')
//            ->requirePresence('weight_date', 'create')
//            ->notEmpty('weight_date');
//
//        $validator
//            ->requirePresence('remark', 'create')
//            ->notEmpty('remark');
//
//        $validator
//            ->integer('status')
//            ->requirePresence('status', 'create')
//            ->notEmpty('status');

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
        $rules->add($rules->existsIn(['horse_id'], 'Horses'));

        return $rules;
    }
}
