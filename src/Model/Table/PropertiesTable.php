<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Properties Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Propertytypes
 * @property \Cake\ORM\Association\HasMany $PropertyImages
 * @property \Cake\ORM\Association\HasMany $PropertyOwnerships
 *
 * @method \App\Model\Entity\Property get($primaryKey, $options = [])
 * @method \App\Model\Entity\Property newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Property[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Property|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Property patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Property[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Property findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PropertiesTable extends Table
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

        $this->table('properties');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Propertytypes', [
            'foreignKey' => 'propertytype_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('projects', [
            'foreignKey' => 'project_id',
            'joinType' => 'INNER'
        ]);
        
        $this->hasMany('PropertyImages', [
            'foreignKey' => 'property_id'
        ]);
        
        $this->hasMany('PropertyViews', [
            'foreignKey' => 'property_id'
        ]);
        
        $this->hasOne('PropertyImagesone', [
            'foreignKey' => 'property_id',
            'className' => 'property_images'
        ]);
        
        $this->hasMany('PropertyOwnerships', [
            'foreignKey' => 'property_id'
        ]);
        
        $this->hasMany('PropertyBids', [
            'foreignKey' => 'property_id'
        ]);
        
        $this->hasOne('PropertyRejects', [
            'foreignKey' => 'property_id'
        ]);
        
        $this->hasMany('PropertyFavourites', [
            'foreignKey' => 'property_id'
        ]);
        
        $this->hasOne('PropertyBidsOne', [
            'foreignKey' => 'property_id',
            'className' => 'property_bids'
        ]);
        
        $this->hasMany('PropertyOwners', [
            'foreignKey' => 'property_id'
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
            ->requirePresence('category', 'create')
            ->notEmpty('category');

//        $validator
//            ->requirePresence('sub_category', 'create')
//            ->notEmpty('sub_category');
//
//        $validator
//            ->requirePresence('price', 'create')
//            ->notEmpty('price');
//
//        $validator
//            ->requirePresence('country', 'create')
//            ->notEmpty('country');
//
//        $validator
//            ->requirePresence('state', 'create')
//            ->notEmpty('state');
//
//        $validator
//            ->requirePresence('city', 'create')
//            ->notEmpty('city');
//
//        $validator
//            ->requirePresence('neighbourhood', 'create')
//            ->notEmpty('neighbourhood');
//
//        $validator
//            ->requirePresence('street', 'create')
//            ->notEmpty('street');
//
//        $validator
//            ->requirePresence('area', 'create')
//            ->notEmpty('area');
//
//        $validator
//            ->requirePresence('number', 'create')
//            ->notEmpty('number');
//
//        $validator
//            ->requirePresence('no_of_room', 'create')
//            ->notEmpty('no_of_room');
//
//        $validator
//            ->allowEmpty('balcony_area');
//
//        $validator
//            ->integer('balcony_type')
//            ->allowEmpty('balcony_type');
//
//        $validator
//            ->requirePresence('parking_type', 'create')
//            ->notEmpty('parking_type');
//
//        $validator
//            ->integer('no_of_floor')
//            ->allowEmpty('no_of_floor');
//
//        $validator
//            ->integer('number_of_parking')
//            ->allowEmpty('number_of_parking');
//
//        $validator
//            ->integer('no_of_elevator')
//            ->allowEmpty('no_of_elevator');
//
//        $validator
//            ->integer('air_direction')
//            ->allowEmpty('air_direction');
//
//        $validator
//            ->integer('ac')
//            ->allowEmpty('ac');
//
//        $validator
//            ->integer('bars')
//            ->allowEmpty('bars');
//
//        $validator
//            ->allowEmpty('secure_space');
//
//        $validator
//            ->integer('master_badroom')
//            ->allowEmpty('master_badroom');
//
//        $validator
//            ->allowEmpty('storage_area');
//
//        $validator
//            ->integer('no_of_shower')
//            ->allowEmpty('no_of_shower');
//
//        $validator
//            ->integer('no_of_wc')
//            ->allowEmpty('no_of_wc');
//
//        $validator
//            ->integer('disable_access')
//            ->requirePresence('disable_access', 'create')
//            ->notEmpty('disable_access');
//
//        $validator
//            ->requirePresence('3dtour', 'create')
//            ->notEmpty('3dtour');
//
//        $validator
//            ->integer('property_condition')
//            ->allowEmpty('property_condition');
//
//        $validator
//            ->requirePresence('condition_text', 'create')
//            ->notEmpty('condition_text');
//
//        $validator
//            ->integer('defects')
//            ->requirePresence('defects', 'create')
//            ->notEmpty('defects');
//
//        $validator
//            ->requirePresence('defects_text', 'create')
//            ->notEmpty('defects_text');
//
//        $validator
//            ->allowEmpty('storage');
//
//        $validator
//            ->date('evaculation_date')
//            ->allowEmpty('evaculation_date');
//
//        $validator
//            ->integer('flexible_evaculation_date')
//            ->requirePresence('flexible_evaculation_date', 'create')
//            ->notEmpty('flexible_evaculation_date');
//
//        $validator
//            ->integer('no_of_payment')
//            ->allowEmpty('no_of_payment');
//
//       $validator
//           ->integer('first_payment')
//           ->requirePresence('first_payment', 'create')
//           ->notEmpty('first_payment');
//
//        $validator
//            ->requirePresence('first_payment_text', 'create')
//            ->notEmpty('first_payment_text');
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        //$rules->add($rules->existsIn(['propertytype_id'], 'Propertytypes'));

        return $rules;
    }
    
    public function findCommon(Query $query, array $options) {
        $searchKeyword = $options['searchKeyword'];
        
        if (!empty($searchKeyword['keyword']) && trim($searchKeyword['keyword'])) {
              $query->where(['Users.name LIKE' => '%' .  trim($searchKeyword['keyword']) . '%' ]);
        }
        if (!empty($searchKeyword['city']) && trim($searchKeyword['city'])) {
              $query->where(['Properties.city LIKE ' => '%' . trim($searchKeyword['city']) . '%']);
        }
        if (!empty($searchKeyword['status']) && trim($searchKeyword['status'])) {
              $query->where(['Properties.status' => trim($searchKeyword['status'])]);
        }
        if (!empty($searchKeyword['handling']) && trim($searchKeyword['handling'])) {
              $query->where(['Properties.handling' => trim($searchKeyword['handling'])]);
        }
        if (!empty($searchKeyword['no_of_room']) && trim($searchKeyword['no_of_room'])) {
              $query->where(['Properties.no_of_room' => trim($searchKeyword['no_of_room'])]);
        }
        if (!empty($searchKeyword['fromprice']) && trim($searchKeyword['fromprice'])) {
              $query->where(['Properties.price >=' => $searchKeyword['fromprice']]);
        }
        if (!empty($searchKeyword['toprice']) && trim($searchKeyword['toprice'])) {
              $query->where(['Properties.price <=' => trim($searchKeyword['toprice'])]);
        }
        if (!empty($searchKeyword['assign']) && trim($searchKeyword['assign'])) {
              $query->where(['Properties.assign =' => trim($searchKeyword['assign'])]);
        }
        if (!empty($searchKeyword['fromdate']) && trim($searchKeyword['fromdate'])) {
              $query->where(['Properties.modified >=' => date('Y-m-d', strtotime($searchKeyword['fromdate'])) ]);
        }
        if (!empty($searchKeyword['todate']) && trim($searchKeyword['todate'])) {
              $query->where(['Properties.modified <=' => date('Y-m-d', strtotime($searchKeyword['todate'])) ]);
        }
        if (!empty($searchKeyword['role']) && trim($searchKeyword['role'])) {
              $query->where(['Users.role_id' => trim($searchKeyword['role'])]);
        }
        
        return $query;
    }
    
    public function findFilter(Query $query , array $options){
        $searchKeyword = $options['searchKeyword'];
        
        if (!empty($searchKeyword['category']) && trim($searchKeyword['category'])) {
              $query->where(['Properties.category IN ' => explode(',',$searchKeyword['category'])]);
        }
        
        if (!empty($searchKeyword['minprice']) && !empty($searchKeyword['maxprice'])) {
              $query->where(['Properties.price >=' => trim($searchKeyword['minprice']) , 'Properties.price <' => trim($searchKeyword['maxprice'])]);
        }
        if (!empty($searchKeyword['minroom']) && !empty($searchKeyword['maxroom'])) {
              $query->where(['Properties.no_of_room >=' => trim($searchKeyword['minroom']) , 'Properties.no_of_room <=' => trim($searchKeyword['maxroom'])]);
        }
        if (!empty($searchKeyword['number_of_parking'])) {
              $query->where(['Properties.number_of_parking IN ' => explode(',',$searchKeyword['number_of_parking'])]);
        }
        if (!empty($searchKeyword['balcony_type'])) {
              $query->where(['Properties.balcony_type IN ' => explode(',',$searchKeyword['balcony_type'])]);
        }
        if (!empty($searchKeyword['type'])) {
              $query->where(['Properties.propertytype_id IN ' => explode(',', $searchKeyword['type'])]);
        }
        if (!empty($searchKeyword['property_condition'])) {
              $query->where(['Properties.property_condition IN ' => explode(',', $searchKeyword['property_condition'])]);
        }
        if (!empty($searchKeyword['evaculation_date'])) {
              $query->where(['Properties.evaculation_date' => $searchKeyword['evaculation_date']]);
        }
        if (isset($searchKeyword['ac'])) {
              if($searchKeyword['ac'] == '0'){
                $query->where(['Properties.ac' => $searchKeyword['ac']]);
              }else{
                  $query->where(['Properties.ac >=' => $searchKeyword['ac']]);
              }
        }
        if (isset($searchKeyword['storage'])) {
              $query->where(['Properties.storage' => $searchKeyword['storage']]);
        }
        if (isset($searchKeyword['bars'])) {
              $query->where(['Properties.bars' => $searchKeyword['bars']]);
        }
        if (isset($searchKeyword['2bath'])) {
              $query->where(['Properties.no_of_shower' => $searchKeyword['2bath']]);
        }
        if (isset($searchKeyword['2restroom'])) {
              $query->where(['Properties.no_of_wc' => $searchKeyword['2restroom']]);
        }
        if (isset($searchKeyword['master_badroom'])) {
              if($searchKeyword['master_badroom'] == '0'){
                $query->where(['Properties.master_badroom' => $searchKeyword['master_badroom']]);
              }else{
                  $query->where(['Properties.master_badroom >=' => $searchKeyword['master_badroom']]);
              }
        }
        
//        if(!empty($searchKeyword['range'])){
//            
//            $query->execute('SELECT
//                    id, (
//                      3959 * acos (
//                        cos ( radians('.$searchKeyword['curr_lat'].') )
//                        * cos( radians( lat ) )
//                        * cos( radians( lng ) - radians('.$searchKeyword['curr_lng'].') )
//                        + sin ( radians('.$searchKeyword['curr_lat'].') )
//                        * sin( radians( lat ) )
//                      )
//                    ) AS distance
//                  FROM properties
//                  HAVING distance < '.$searchKeyword['range'].'
//                  ORDER BY distance
//                  LIMIT 0 , 20');
//        }
        
        $query->hydrate(false);
        return $query;
    }
}
