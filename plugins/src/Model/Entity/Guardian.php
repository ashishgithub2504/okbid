<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
/**
 * Guardian Entity
 *
 * @property int $id
 * @property string $auth_token
 * @property string $name
 * @property string $guardian_pic
 * @property string $relationship
 * @property int $mobile
 * @property int $home_number
 * @property string $email
 * @property string $password
 * @property int $reset_key
 * @property string $address
 * @property int $is_verified
 * @property int $is_password
 * @property int $is_activation
 * @property int $status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Child $child
 * @property \App\Model\Entity\GuardianChild[] $guardian_childs
 * @property \App\Model\Entity\Message[] $messages
 */
class Guardian extends Entity
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

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
    
    protected function _setPassword($password){
        return (new DefaultPasswordHasher)->hash($password);
    }
    
}
