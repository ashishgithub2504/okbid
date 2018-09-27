<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Campaigns Model
 *
 * @method \App\Model\Entity\Campaign get($primaryKey, $options = [])
 * @method \App\Model\Entity\Campaign newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Campaign[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Campaign|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Campaign patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Campaign[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Campaign findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CampaignsTable extends Table
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

        $this->table('campaigns');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->hasMany('MailRecords', [
            'foreignKey' => 'campaign_id'
        ]);

        $this->belongsToMany('Users', [
            'foreignKey' => 'campaign_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'mail_records',
            'saveStrategy' => 'append'
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
            ->allowEmpty('name');
        
        $validator
            ->requirePresence('subject', 'create')
            ->allowEmpty('subject');

        $validator
            ->requirePresence('description', 'create')
            ->allowEmpty('description');

        $validator
            ->integer('status')
            ->allowEmpty('status');

        return $validator;
    }
    
    public function findCommon(Query $query, array $options) {
        $searchKeyword = $options['searchKeyword'];
        if (!empty($searchKeyword['keyword']) && trim($searchKeyword['keyword'])) {
            $query->where(['name LIKE ' => '%' . trim($searchKeyword['keyword']) . '%']);
            $query->orWhere(['subject LIKE ' => '%' . trim($searchKeyword['keyword']) . '%']);
        }

        return $query;
    }
}
