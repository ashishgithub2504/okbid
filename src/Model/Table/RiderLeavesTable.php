<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RiderLeaves Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Riders
 *
 * @method \App\Model\Entity\RiderLeave get($primaryKey, $options = [])
 * @method \App\Model\Entity\RiderLeave newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RiderLeave[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RiderLeave|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RiderLeave patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RiderLeave[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RiderLeave findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RiderLeavesTable extends Table
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

        $this->table('rider_leaves');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

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

        $validator
            ->date('leave_end_date')
            ->requirePresence('leave_end_date', 'create')
            ->notEmpty('leave_end_date');

        $validator
            ->date('leave_start_date')
            ->requirePresence('leave_start_date', 'create')
            ->notEmpty('leave_start_date');

        $validator
            ->allowEmpty('reasons');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

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
        $rules->add($rules->existsIn(['rider_id'], 'Riders'));

        return $rules;
    }
}
