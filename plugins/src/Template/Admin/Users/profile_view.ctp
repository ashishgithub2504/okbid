<section class="content-header">
    <h1>
        Manage Users <small>User profile</small>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php echo $this->Flash->render(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover table-bordered">           
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
                            <th><?= __('Name') ?></th>
                            <td><?= h($user->name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Email') ?></th>
                            <td><?= h($user->email) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Username') ?></th>
                            <td><?= h($user->username) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Phone') ?></th>
                            <td><?= h($user->phone) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Status') ?></th>
                            <td><?php
                                if ($user->status == 1) {
                                    echo '<span class="label label-success"> Active </span>';
                                } else {
                                    echo '<span class="label label-danger"> Inactive </span>';
                                }
                                ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Register Date') ?></th>
                            <td>
                                <?php
                                if ($user->created != "") {
                                    echo $user->created->format('d-M-Y');
                                }
                                ?>
                            </td>
                        </tr>
                       
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

