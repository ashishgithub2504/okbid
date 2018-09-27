<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Rider Entity
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property int $country_id
 * @property string $nf_number
 * @property string $eef_licence_number
 * @property string $fei_licence_number
 * @property string $qualification
 * @property int $noc_status
 * @property string $remarks
 * @property int $status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Country $country
 */
class Rider extends Entity
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
