<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * HorseTransfer Entity
 *
 * @property int $id
 * @property int $horse_id
 * @property \Cake\I18n\Time $transfer_date
 * @property string $arrival
 * @property string $departure
 * @property string $stable_name
 * @property string $person_name
 * @property string $remark
 * @property int $status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Horse $horse
 */
class HorseTransfer extends Entity
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
