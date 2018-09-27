<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Riders Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Countries
 *
 * @method \App\Model\Entity\Rider get($primaryKey, $options = [])
 * @method \App\Model\Entity\Rider newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Rider[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Rider|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rider patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Rider[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Rider findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RidersTable extends Table
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
        $this->_dir = 'uploads' . DS . 'images' . DS;
        $this->table('riders');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->addBehavior('Upload', [
            'fields' => [
                'image' => [
                    'path' => $this->_dir . ':name'
                ]
            ]
                ]
        );
        
		$this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER'
        ]);
		
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');


        $validator
            ->integer('noc_status')
            ->requirePresence('noc_status', 'create')
            ->notEmpty('noc_status');


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
        $rules->add($rules->existsIn(['country_id'], 'Countries'));

        return $rules;
    }
}
