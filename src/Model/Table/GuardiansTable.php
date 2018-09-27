<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Guardians Model
 *
 * @property \Cake\ORM\Association\HasMany $GuardianChilds
 * @property \Cake\ORM\Association\HasMany $Messages
 *
 * @method \App\Model\Entity\Guardian get($primaryKey, $options = [])
 * @method \App\Model\Entity\Guardian newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Guardian[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Guardian|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Guardian patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Guardian[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Guardian findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class GuardiansTable extends Table
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
        $this->_dir = 'uploads' . DS . 'users' . DS;
        $this->table('guardians');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

//        $this->belongsTo('Childs', [
//            'foreignKey' => 'guardian_id'
//        ]);
//        
        $this->belongsToMany('Childs', [
            'foreignKey' => 'guardian_id'
        ]);
        
        $this->hasMany('Messages', [
            'foreignKey' => 'guardian_id'
        ]);
        
        $this->addBehavior('Upload', [
            'fields' => [
                'guardian_pic' => [
                    'path' => $this->_dir . ':name'
                ]
            ]
                ]
        );
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

//        $validator
//            ->requirePresence('password', 'create')
//            ->notEmpty('password');
//
//        $validator
//            ->integer('reset_key')
//            ->allowEmpty('reset_key');
//
//        $validator
//            ->requirePresence('address', 'create')
//            ->notEmpty('address');
//
//        $validator
//            ->integer('is_verified')
//            ->requirePresence('is_verified', 'create')
//            ->notEmpty('is_verified');
//
//        $validator
//            ->integer('is_password')
//            ->requirePresence('is_password', 'create')
//            ->notEmpty('is_password');
//
//        $validator
//            ->integer('is_activation')
//            ->requirePresence('is_activation', 'create')
//            ->notEmpty('is_activation');
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
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
