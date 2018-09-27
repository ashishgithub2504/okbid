<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PropertyOwnerships Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Properties
 *
 * @method \App\Model\Entity\PropertyOwnership get($primaryKey, $options = [])
 * @method \App\Model\Entity\PropertyOwnership newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PropertyOwnership[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PropertyOwnership|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PropertyOwnership patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PropertyOwnership[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PropertyOwnership findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PropertyOwnershipsTable extends Table
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

        $this->table('property_ownerships');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->_dir  = 'uploads' . DS . 'document' . DS;
        
        $this->addBehavior('Upload', [
            'fields' => [
                'image' => [
                    'path' => $this->_dir . ':id'.DS . ':name'
                ],
                'file' => [
                    'path' => $this->_dir . ':id'.DS . ':name'
                ]
            ]
                ]
        );
        
        
        
        $this->belongsTo('Properties', [
            'foreignKey' => 'property_id',
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
//            ->requirePresence('image', 'create')
//            ->notEmpty('image');

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
        $rules->add($rules->existsIn(['property_id'], 'Properties'));

        return $rules;
    }
}
