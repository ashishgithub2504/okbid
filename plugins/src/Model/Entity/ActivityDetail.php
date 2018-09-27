<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ActivityDetail Entity
 *
 * @property int $id
 * @property int $activity_id
 * @property int $category_id
 * @property string $input
 * @property string $output
 *
 * @property \App\Model\Entity\Activity $activity
 * @property \App\Model\Entity\Category $category
 */
class ActivityDetail extends Entity
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
