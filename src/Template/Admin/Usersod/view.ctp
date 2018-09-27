<?php
 $user_type = 'Users';
?>
<section class="content-header">
    <h1>
        Manage <?= $user_type ?>
        <small><?= $user_type ?> info</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th><?= __('ID') ?></th>
                            <td>#<?= h($user->id) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Profile Photo') ?></th>
                            <td>
                                <?php
                                if (!empty($user->profile_pic) && file_exists(WWW_ROOT . "uploads/users/" . $user->profile_pic)) {

                                    echo $this->Html->image(_BASE_ . "uploads/users/" . $user->profile_pic, ['width' => 150, 'height' => 130]);
                                } else {
                                    echo $this->Html->image('no-image.png', ['width' => 150, 'height' => 130]);
                                }
                                ?>
                            </td>
                        </tr>


                        <tr>
                            <th><?= __('Manager Name') ?></th>
                            <td><?= h($user->name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Name of Nursery') ?></th>
                            <td><?= h($user->username) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Email') ?></th>
                            <td><?= h($user->email) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Contact Number') ?></th>
                            <td><?= h($user->phone) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Mobile Number') ?></th>
                            <td><?= h($user->phone) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Activation Code') ?></th>
                            <td><?= h($user->activation_code) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Nursery Address') ?></th>
                            <td><?= h($user->address) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Account Expiry Date') ?></th>
                            <td><?= $user->expiry_date->format($SettingConfig['admin_date_format']) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Gender') ?></th>
                            <td>
                                <?php echo $user->gender == 1 ? "Male" : "Female"; ?>
                            </td>
                        </tr>
                        
                        <tr>
                            <th><?= __('Last Login') ?></th>
                            <td>
                                <?php
                                if ($user->last_login != "") {
                                    echo $user->last_login->format($SettingConfig['admin_date_format']);
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?= __('Status') ?></th>
                            <td><?= $user->status == 1 ? __('Active') : __('DeActive'); ?></td>
                        </tr>
                        
                        
                    </table>
                    <?php if ($user->role_id == 3) { ?>
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title"><b>Customer Addresses</b></h3>
                            </div>
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <th>#</th>
                                        <th>Address Line 1</th>
                                        <th>Address Line 2</th>
                                        <th>Postcode</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                    </tr>
                                    <?php
                                    if (!empty($user->user_addresses)) {
                                        foreach ($user->user_addresses as $k => $address) {
                                            ?>
                                            <tr>
                                                <td><?php echo $k+1; ?></td>
                                                <td><?php echo $address->address_line_1; ?></td>
                                                <td><?php echo $address->address_line_2; ?></td>
                                                <td><?php echo $address->postcode; ?></td>
                                                <td><?php echo $address->latitude; ?></td>
                                                <td><?php echo $address->longitude; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo '<tr><td colspan="6">No address found</td></tr>';
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>