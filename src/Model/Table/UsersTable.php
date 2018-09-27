<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Roles
 * @property \Cake\ORM\Association\HasMany $Groups
 * @property \Cake\ORM\Association\HasMany $MailRecords
 * @property \Cake\ORM\Association\HasMany $Messages
 * @property \Cake\ORM\Association\HasMany $Testimonials
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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
        
        $this->table('users');
        $this->displayField('name');
        $this->primaryKey('id');
        
        
        $this->addBehavior('Timestamp');
        
        $this->addBehavior('Upload', [
            'fields' => [
                'profile_pic' => [
                    'path' => $this->_dir . ':name'
                ]
            ]
                ]
        );
        
        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER'
        ]);
		
	$this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
		
        $this->hasMany('Groups', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('MailRecords', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Messages', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Testimonials', [
            'foreignKey' => 'user_id'
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
//            ->requirePresence('activation_code', 'create')
//            ->notEmpty('activation_code');
//
//        $validator
//            ->allowEmpty('auth_token');
//
//        $validator
//            ->requirePresence('name', 'create')
//            ->notEmpty('name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('username');
//
        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');
//
//        $validator
//            ->requirePresence('phone', 'create')
//            ->notEmpty('phone');
//
//        $validator
//            ->requirePresence('mobile', 'create')
//            ->notEmpty('mobile');
//
//        $validator
//            ->requirePresence('nf_number', 'create')
//            ->notEmpty('nf_number');
//
//        $validator
//            ->date('expiry_date')
//            ->requirePresence('expiry_date', 'create')
//            ->notEmpty('expiry_date');
//
//        $validator
//            ->requirePresence('address', 'create')
//            ->notEmpty('address');
//
//        $validator
//            ->allowEmpty('gender');
//
//        $validator
//            ->requirePresence('nationality', 'create')
//            ->notEmpty('nationality');
//
//        $validator
//            ->allowEmpty('profile_pic');
//
//        $validator
//            ->integer('online_status')
//            ->requirePresence('online_status', 'create')
//            ->notEmpty('online_status');
//
//        $validator
//            ->allowEmpty('verification_code');
//
//        $validator
//            ->allowEmpty('reset_key');
//
//        $validator
//            ->allowEmpty('eef_licence_number');
//
//        $validator
//            ->allowEmpty('login_by');
//
//        $validator
//            ->dateTime('last_login')
//            ->allowEmpty('last_login');
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
//            ->allowEmpty('fel_licence_number');
//
//        $validator
//            ->allowEmpty('qualification');
//
//        $validator
//            ->allowEmpty('noc_status');
//
//        $validator
//            ->allowEmpty('remarks');
//
//        $validator
//            ->boolean('status')
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
        $rules->add($rules->isUnique(['email'],'Email address already in use'));
        $rules->add($rules->isUnique(['phone'],'Phone number already in use'));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));

        return $rules;
    }
    
    public function findCommon(Query $query, array $options) {
        $searchKeyword = $options['searchKeyword'];
        
        if (!empty($searchKeyword['keyword']) && trim($searchKeyword['keyword'])) {
            $query->where(['Users.name LIKE ' => '%' . trim($searchKeyword['keyword']) . '%']);
            $query->orWhere(['username LIKE ' => '%' . trim($searchKeyword['keyword']) . '%']);
            $query->orWhere(['email LIKE ' => '%' . trim($searchKeyword['keyword']) . '%']);
        }
        if (!empty($searchKeyword['roles']) && trim($searchKeyword['roles'])) {
              $query->where(['role_id' => trim($searchKeyword['roles'])]);
        }
        if (!empty($searchKeyword['city']) && trim($searchKeyword['city'])) {
              $query->where(['city' => trim($searchKeyword['city'])]);
        }
        if (!empty($searchKeyword['manager_id']) && trim($searchKeyword['manager_id'])) {
              $query->where(['manager_id' => trim($searchKeyword['manager_id'])]);
        }
        if (!empty($searchKeyword['company']) && trim($searchKeyword['company'])) {
              $query->where(['company' => trim($searchKeyword['company'])]);
        }
        if (isset($searchKeyword['status'])) {
            
              $query->where(['Users.status' => $searchKeyword['status']]);
        }
        if (!empty($searchKeyword['created']) && trim($searchKeyword['created'])) {
              $query->where(['Users.created' => date('Y-m-d', strtotime($searchKeyword['created']))]);
        }
        
        return $query;
    }
//
    public function findAuthAdmin(Query $query, array $options) {
        $query
                ->select()
                ->where(['Users.status' => 1])
                ->where(['Users.role_id IN' => ['1','3','4','5','6']]);

        return $query;
    }
    
    public function findAuthCustomer(Query $query, array $options) {
       
        $query
                ->select()
                ->where(['Users.status' => '1','Users.role_id IN' => ['2']]);

        return $query;
    }
    
    public function findAuthUser(Query $query, array $options) {
        $query
                ->select()
                ->where(['Users.role_id' => 2]);

        return $query;
    }
    
}
