<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Property Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $category
 * @property string $sub_category
 * @property string $price
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $neighbourhood
 * @property string $street
 * @property int $propertytype_id
 * @property string $area
 * @property int $number
 * @property int $no_of_room
 * @property string $balcony_area
 * @property int $balcony_type
 * @property int $parking_type
 * @property int $no_of_floor
 * @property int $number_of_parking
 * @property int $no_of_elevator
 * @property int $air_direction
 * @property int $ac
 * @property int $bars
 * @property string $secure_space
 * @property int $master_badroom
 * @property string $storage_area
 * @property int $no_of_shower
 * @property int $no_of_wc
 * @property int $disable_access
 * @property string $3dtour
 * @property int $property_condition
 * @property string $condition_text
 * @property int $defects
 * @property string $defects_text
 * @property string $storage
 * @property \Cake\I18n\Time $evaculation_date
 * @property int $flexible_evaculation_date
 * @property int $no_of_payment
 * @property int $first_payment
 * @property string $first_payment_text
 * @property int $status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Propertytype $propertytype
 * @property \App\Model\Entity\PropertyImage[] $property_images
 */
class Property extends Entity
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
