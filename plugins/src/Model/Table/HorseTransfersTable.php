<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HorseTransfers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Horses
 *
 * @method \App\Model\Entity\HorseTransfer get($primaryKey, $options = [])
 * @method \App\Model\Entity\HorseTransfer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\HorseTransfer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HorseTransfer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HorseTransfer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HorseTransfer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\HorseTransfer findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class HorseTransfersTable extends Table
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

        $this->table('horse_transfers');
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

        $validator
            ->date('transfer_date')
            ->requirePresence('transfer_date', 'create')
            ->notEmpty('transfer_date');

//        $validator
//            ->requirePresence('arrival', 'create')
//            ->notEmpty('arrival');
//
//        $validator
//            ->requirePresence('departure', 'create')
//            ->notEmpty('departure');
//
//        $validator
//            ->requirePresence('stable_name', 'create')
//            ->notEmpty('stable_name');
//
//        $validator
//            ->allowEmpty('person_name');
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
