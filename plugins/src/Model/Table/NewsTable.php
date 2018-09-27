<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Filesystem\File;

/**
 * News Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Categories
 *
 * @method \App\Model\Entity\News get($primaryKey, $options = [])
 * @method \App\Model\Entity\News newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\News[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\News|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\News patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\News[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\News findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class NewsTable extends Table
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
        $this->_dir = 'uploads' . DS . 'news' . DS;

        $this->table('news');
        $this->displayField('title');
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->allowEmpty('short_desc');

        $validator
            ->allowEmpty('image');

        $validator
            ->allowEmpty('description');

        $validator
            ->integer('status')
            ->allowEmpty('status');

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
            $query->where(['title LIKE ' => '%' . trim($searchKeyword['keyword']) . '%']);
        }
        if (isset($searchKeyword['category_id']) && !empty($searchKeyword['category_id']) && $searchKeyword['category_id'] != 'all') {
            $category_id = $searchKeyword['category_id'];
            $query->matching('Categories', function ($q) use ($category_id) {
                return $q->where(['category_id' => $category_id]);
            });
        }
        return $query;
    }
    
    public function deleteImage($image = '', $record = null) {
        if (!empty($image)) {
            $file = new File($this->_dir . $image, false);
            if ($file->exists()) {
                $file->delete();
            }
        }
        if (!empty($record)) {
            $record->image = '';
            return $this->save($record);
        }
        return true;
    }
}
