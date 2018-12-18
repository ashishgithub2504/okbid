<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Filesystem\File;

/**
 * Images Model
 *
 * @method \App\Model\Entity\Image get($primaryKey, $options = [])
 * @method \App\Model\Entity\Image newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Image[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Image|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Image patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Image[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Image findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ImagesTable extends Table
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
        
        
        $this->table('images');
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
            ->integer('type')
            ->allowEmpty('type');

        
        $validator
            ->requirePresence('image_file', 'create')
            ->allowEmpty('image_file');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }
    
        
    public function findCommon(Query $query, array $options) {
        $searchKeyword = $options['searchKeyword'];
        if (!empty($searchKeyword['keyword']) && trim($searchKeyword['keyword'])) {
            $query->where(['title LIKE ' => '%' . trim($searchKeyword['keyword']) . '%']);
        }

        $type = $options['type'];
        $query->where(['type' => $type]);
        
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
