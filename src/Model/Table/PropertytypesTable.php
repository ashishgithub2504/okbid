<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Propertytypes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Categories
 * @property \Cake\ORM\Association\HasMany $Properties
 *
 * @method \App\Model\Entity\Propertytype get($primaryKey, $options = [])
 * @method \App\Model\Entity\Propertytype newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Propertytype[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Propertytype|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Propertytype patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Propertytype[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Propertytype findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PropertytypesTable extends Table
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

        $this->table('propertytypes');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id'
        ]);
        $this->hasMany('Properties', [
            'foreignKey' => 'propertytype_id'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

       
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
        $rules->add($rules->existsIn(['category_id'], 'Categories'));

        return $rules;
    }
    
    public function findCommon(Query $query, array $options) {
        $searchKeyword = $options['searchKeyword'];
        if (!empty($searchKeyword['keyword']) && trim($searchKeyword['keyword'])) {
              $query->where(['OR'=>['Propertytypes.name LIKE' => '%' .  trim($searchKeyword['keyword']) . '%' , 'Propertytypes.namehe LIKE' => '%' .  trim($searchKeyword['keyword']) . '%' ]]);
        }
        
        return $query;
    }
}
