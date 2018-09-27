<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Users
        <small>Users info</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th scope="row"><?= __('Activation Code') ?></th>
                            <td><?= h($user->activation_code) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Auth Token') ?></th>
                            <td><?= h($user->auth_token) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Name') ?></th>
                            <td><?= h($user->name) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Email') ?></th>
                            <td><?= h($user->email) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Role') ?></th>
                            <td><?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Username') ?></th>
                            <td><?= h($user->username) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Password') ?></th>
                            <td><?= h($user->password) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Nf Number') ?></th>
                            <td><?= h($user->nf_number) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Address') ?></th>
                            <td><?= h($user->address) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Nationality') ?></th>
                            <td><?= h($user->nationality) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Profile Pic') ?></th>
                            <td><?= h($user->profile_pic) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Verification Code') ?></th>
                            <td><?= h($user->verification_code) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Reset Key') ?></th>
                            <td><?= h($user->reset_key) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Eef Licence Number') ?></th>
                            <td><?= h($user->eef_licence_number) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Login By') ?></th>
                            <td><?= h($user->login_by) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Fel Licence Number') ?></th>
                            <td><?= h($user->fel_licence_number) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Qualification') ?></th>
                            <td><?= h($user->qualification) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Noc Status') ?></th>
                            <td><?= h($user->noc_status) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Id') ?></th>
                            <td><?= $this->Number->format($user->id) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Phone') ?></th>
                            <td><?= $this->Number->format($user->phone) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Mobile') ?></th>
                            <td><?= $this->Number->format($user->mobile) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Online Status') ?></th>
                            <td><?= $this->Number->format($user->online_status) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Is Verified') ?></th>
                            <td><?= $this->Number->format($user->is_verified) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Is Password') ?></th>
                            <td><?= $this->Number->format($user->is_password) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Is Activation') ?></th>
                            <td><?= $this->Number->format($user->is_activation) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Expiry Date') ?></th>
                            <td><?= h($user->expiry_date) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Last Login') ?></th>
                            <td><?= h($user->last_login) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Modified') ?></th>
                            <td><?= h($user->modified) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?= h($user->created) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                            <td><?= $user->status ? __('Yes') : __('No'); ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Gender') ?></th>
                            <td><?= $this->Text->autoParagraph(h($user->gender)); ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Remarks') ?></th>
                            <td><?= $this->Text->autoParagraph(h($user->remarks)); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>