<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Horses Model
 *
 * @method \App\Model\Entity\Horse get($primaryKey, $options = [])
 * @method \App\Model\Entity\Horse newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Horse[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Horse|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Horse patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Horse[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Horse findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class HorsesTable extends Table
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
        $this->table('horses');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->addBehavior('Upload', [
            'fields' => [
                'image' => [
                    'path' => $this->_dir . ':name'
                ],
                'image1' => [
                    'path' => $this->_dir . ':name'
                ],
                'image2' => [
                    'path' => $this->_dir . ':name'
                ]
            ]
                ]
        );
        
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id'
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

      
        return $validator;
    }
}
