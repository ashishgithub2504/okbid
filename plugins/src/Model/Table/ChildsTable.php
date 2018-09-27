<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Childs Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $Activities
 * @property \Cake\ORM\Association\HasMany $GuardianChilds
 * @property \Cake\ORM\Association\HasMany $Guardians
 *
 * @method \App\Model\Entity\Child get($primaryKey, $options = [])
 * @method \App\Model\Entity\Child newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Child[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Child|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Child patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Child[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Child findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ChildsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);
        $this->_dir = 'uploads' . DS . 'users' . DS;
        $this->table('childs');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Activities', [
            'foreignKey' => 'child_id'
        ]);

//        $this->hasOne('Guardians', [
//            'foreignKey' => 'child_id'
//        ]);
//        
        $this->belongsTo('Groups', [
            'foreignKey' => 'group_id'
        ]);
        
        $this->belongsToMany('Guardians', [
            'foreignKey' => 'child_id',
            'dependent' => true
        ]);


        $this->addBehavior('Upload', [
            'fields' => [
                'profile_pic' => [
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
    public function validationDefault(Validator $validator) {
        $validator
                ->allowEmpty('id', 'create');

        $validator
                ->requirePresence('name', 'create')
                ->notEmpty('name');

        $validator
                ->date('dob')
                ->requirePresence('dob', 'create')
                ->notEmpty('dob');


        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

}
