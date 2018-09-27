<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PropertyAutobid Entity
 *
 * @property int $id
 * @property int $property_id
 * @property string $user_id
 * @property int $price
 * @property int $status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Property $property
 * @property \App\Model\Entity\User $user
 */
class PropertyAutobid extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
