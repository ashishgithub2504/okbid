<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ActivityDetails Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Activities
 * @property \Cake\ORM\Association\BelongsTo $Categories
 *
 * @method \App\Model\Entity\ActivityDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\ActivityDetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ActivityDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ActivityDetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ActivityDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ActivityDetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ActivityDetail findOrCreate($search, callable $callback = null, $options = [])
 */
class ActivityDetailsTable extends Table
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
        $this->_dir = 'uploads' . DS . 'activity' . DS;
        $this->table('activity_details');
        $this->displayField('id');
        $this->primaryKey('id');
        
        $this->addBehavior('Upload', [
            'fields' => [
                'output' => [
                    'path' => $this->_dir . ':name'
                ]
            ]
                ]
        );
        
        $this->belongsTo('Activities', [
            'foreignKey' => 'activity_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
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
            ->requirePresence('input', 'create')
            ->notEmpty('input');

        $validator
            ->requirePresence('output', 'create')
            ->notEmpty('output');

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
        $rules->add($rules->existsIn(['activity_id'], 'Activities'));
        $rules->add($rules->existsIn(['category_id'], 'Categories'));

        return $rules;
    }
}
