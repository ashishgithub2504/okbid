<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * HorsePassport Entity
 *
 * @property int $id
 * @property int $horse_id
 * @property string $passport_number
 * @property \Cake\I18n\Time $renue_date
 * @property string $remarks
 * @property int $status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Horse $horse
 */
class HorsePassport extends Entity
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
