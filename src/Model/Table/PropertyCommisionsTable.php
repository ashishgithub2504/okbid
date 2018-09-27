<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PropertyCommisions Model
 *
 * @method \App\Model\Entity\PropertyCommision get($primaryKey, $options = [])
 * @method \App\Model\Entity\PropertyCommision newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PropertyCommision[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PropertyCommision|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PropertyCommision patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PropertyCommision[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PropertyCommision findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PropertyCommisionsTable extends Table
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

        $this->table('property_commisions');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('roles');
        $this->belongsTo('users');
        $this->addBehavior('Timestamp');
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
            ->integer('category')
            ->requirePresence('category', 'create')
            ->notEmpty('category');

        
        
        $validator
            ->requirePresence('commision', 'create')
            ->notEmpty('commision');

        $validator
            ->integer('status')
            ->allowEmpty('status');

        return $validator;
    }
}
