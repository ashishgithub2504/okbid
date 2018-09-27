<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RiderDocuments Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Riders
 *
 * @method \App\Model\Entity\RiderDocument get($primaryKey, $options = [])
 * @method \App\Model\Entity\RiderDocument newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RiderDocument[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RiderDocument|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RiderDocument patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RiderDocument[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RiderDocument findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RiderDocumentsTable extends Table
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
        $this->_dir = 'uploads' . DS . 'document' . DS;
        $this->table('rider_documents');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->addBehavior('Upload', [
            'fields' => [
                'document' => [
                    'path' => $this->_dir . ':name'
                ]
            ]
                ]
        );
        
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        
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
