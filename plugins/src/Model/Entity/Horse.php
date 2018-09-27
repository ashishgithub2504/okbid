<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Horse Entity
 *
 * @property int $id
 * @property string $fei_number
 * @property string $eef_number
 * @property string $chipid
 * @property string $birth_name
 * @property string $name
 * @property string $image
 * @property \Cake\I18n\Time $dob
 * @property string $height
 * @property string $sire
 * @property string $dam
 * @property int $gender
 * @property string $color
 * @property string $breed
 * @property string $country_birth
 * @property int $status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Horse extends Entity
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
