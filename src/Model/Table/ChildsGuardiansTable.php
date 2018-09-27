<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ChildsGuardians Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Children
 * @property \Cake\ORM\Association\BelongsTo $Guardians
 *
 * @method \App\Model\Entity\ChildsGuardian get($primaryKey, $options = [])
 * @method \App\Model\Entity\ChildsGuardian newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ChildsGuardian[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ChildsGuardian|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ChildsGuardian patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ChildsGuardian[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ChildsGuardian findOrCreate($search, callable $callback = null, $options = [])
 */
class ChildsGuardiansTable extends Table
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

        $this->table('childs_guardians');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Childs', [
            'foreignKey' => 'child_id',
            'joinType' => 'INNER',
            'dependent' => true
        ]);
        $this->belongsTo('Guardians', [
            'foreignKey' => 'guardian_id',
            'joinType' => 'INNER',
            'dependent' => true
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
            ->integer('is_login')
            ->allowEmpty('is_login');

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
        $rules->add($rules->existsIn(['child_id'], 'Childs'));
        $rules->add($rules->existsIn(['guardian_id'], 'Guardians'));

        return $rules;
    }
}
