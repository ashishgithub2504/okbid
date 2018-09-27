<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HorsePerformances Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Horses
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\HorsePerformance get($primaryKey, $options = [])
 * @method \App\Model\Entity\HorsePerformance newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\HorsePerformance[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HorsePerformance|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HorsePerformance patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HorsePerformance[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\HorsePerformance findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class HorsePerformancesTable extends Table
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

        $this->table('horse_performances');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Horses', [
            'foreignKey' => 'horse_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Riders', [
            'foreignKey' => 'rider_id',
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
            ->allowEmpty('id', 'create');

//        $validator
//            ->dateTime('running_date')
//            ->requirePresence('running_date', 'create')
//            ->notEmpty('running_date');

        $validator
            ->allowEmpty('sponsor');

        $validator
            ->allowEmpty('place');

        $validator
            ->allowEmpty('where');

        $validator
            ->allowEmpty('reason');

        $validator
            ->allowEmpty('remark');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
