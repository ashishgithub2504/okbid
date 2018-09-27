<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
/**
 * User Entity
 *
 * @property int $id
 * @property string $activation_code
 * @property string $auth_token
 * @property string $name
 * @property string $email
 * @property int $role_id
 * @property string $username
 * @property string $password
 * @property int $phone
 * @property int $mobile
 * @property string $nf_number
 * @property \Cake\I18n\Time $expiry_date
 * @property string $address
 * @property string $gender
 * @property string $nationality
 * @property string $profile_pic
 * @property int $online_status
 * @property string $verification_code
 * @property string $reset_key
 * @property string $eef_licence_number
 * @property string $login_by
 * @property \Cake\I18n\Time $last_login
 * @property int $is_verified
 * @property int $is_password
 * @property int $is_activation
 * @property string $fel_licence_number
 * @property string $qualification
 * @property string $noc_status
 * @property string $remarks
 * @property bool $status
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $created
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\Group[] $groups
 * @property \App\Model\Entity\HorsePerformance[] $horse_performances
 * @property \App\Model\Entity\MailRecord[] $mail_records
 * @property \App\Model\Entity\Message[] $messages
 * @property \App\Model\Entity\Testimonial[] $testimonials
 */
class User extends Entity {

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

    protected function _setPassword($password) {
        return (new DefaultPasswordHasher)->hash($password);
    }

}
