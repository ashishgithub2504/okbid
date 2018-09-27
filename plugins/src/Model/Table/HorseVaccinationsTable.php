<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HorseVaccinations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Horses
 *
 * @method \App\Model\Entity\HorseVaccination get($primaryKey, $options = [])
 * @method \App\Model\Entity\HorseVaccination newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\HorseVaccination[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HorseVaccination|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HorseVaccination patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HorseVaccination[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\HorseVaccination findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class HorseVaccinationsTable extends Table
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

        $this->table('horse_vaccinations');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Horses', [
            'foreignKey' => 'horse_id',
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

        $validator
            ->date('vaccination_date')
            ->requirePresence('vaccination_date', 'create')
            ->notEmpty('vaccination_date');

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
        $rules->add($rules->existsIn(['horse_id'], 'Horses'));

        return $rules;
    }
}
