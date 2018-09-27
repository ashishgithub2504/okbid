<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Users
        <small>All Users List</small>
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
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-fw fa-circle-o"></i> <span
                            class="caption-subject font-green bold uppercase">Users</span></h3>
                    <div class="box-tools">
                        <?php echo $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('Add User'), ["action" => "add"], ["class" => "btn btn-block btn-primary", "escape" => false]); ?>
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <div class="row">
                        <?php
                        echo $this->Form->create(false, ['type' => 'get', 'id' => 'filterForm', 'role' => 'form', 'inputDefaults' => ['div' => false, 'label' => false]]);
                        ?>
                        <div class="col-md-3">
                            <label for="keyword">Keyword</label>

                            <div class="input-group">
                                <?php echo $this->Form->input('keyword', ['class' => 'form-control input-sm pull-right', 'placeholder' => 'Keyword', 'label' => false, 'value' => !empty($this->request->query['keyword']) ? $this->request->query['keyword'] : '']); ?>
                                <div class="input-group-btn">
                                    <?php echo $this->Form->button('<i class="fa fa-search"></i>', ['class' => 'btn btn-sm btn-default', 'type' => 'Submit', 'escape' => false]); ?>
                                </div>
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('activation_code') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('auth_token') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('role_id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('username') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('password') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('mobile') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('nf_number') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('expiry_date') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('nationality') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('profile_pic') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('online_status') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('verification_code') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('reset_key') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('eef_licence_number') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('login_by') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('last_login') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('is_verified') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('is_password') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('is_activation') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('fel_licence_number') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('qualification') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('noc_status') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($users) > 0):
                            foreach ($users as $user): ?>
                            <tr>
                                <td><?= $this->Number->format($user->id) ?></td>
                                <td><?= h($user->activation_code) ?></td>
                                <td><?= h($user->auth_token) ?></td>
                                <td><?= h($user->name) ?></td>
                                <td><?= h($user->email) ?></td>
                                <td><?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
                                <td><?= h($user->username) ?></td>
                                <td><?= h($user->password) ?></td>
                                <td><?= $this->Number->format($user->phone) ?></td>
                                <td><?= $this->Number->format($user->mobile) ?></td>
                                <td><?= h($user->nf_number) ?></td>
                                <td><?= h($user->expiry_date) ?></td>
                                <td><?= h($user->address) ?></td>
                                <td><?= h($user->nationality) ?></td>
                                <td><?= h($user->profile_pic) ?></td>
                                <td><?= $this->Number->format($user->online_status) ?></td>
                                <td><?= h($user->verification_code) ?></td>
                                <td><?= h($user->reset_key) ?></td>
                                <td><?= h($user->eef_licence_number) ?></td>
                                <td><?= h($user->login_by) ?></td>
                                <td><?php if ($user->last_login != "") echo $user->last_login->format('d-M-Y'); ?></td>
                                <td><?= $this->Number->format($user->is_verified) ?></td>
                                <td><?= $this->Number->format($user->is_password) ?></td>
                                <td><?= $this->Number->format($user->is_activation) ?></td>
                                <td><?= h($user->fel_licence_number) ?></td>
                                <td><?= h($user->qualification) ?></td>
                                <td><?= h($user->noc_status) ?></td>
                                <td><?= h($user->status) ?></td>
                                <td><?php if ($user->modified != "") echo $user->modified->format('d-M-Y'); ?></td>
                                <td><?php if ($user->created != "") echo $user->created->format('d-M-Y'); ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> View'), ['action' => 'view', $user->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                    <?= $this->Html->link(__('<i class="fa fa-edit"></i> Edit'), ['action' => 'edit', $user->id], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?>
                                    <?= $this->Form->postLink('<i class="fa fa-trash"></i> Delete', ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'btn btn-danger btn-sm', 'escape' => false]) ?>
                                </td>
                            </tr>
                            <?php endforeach;
                            else:
                                echo "<tr> <td colspan='6' align='center'> <strong>No User Found</strong> </td> </tr>";
                            endif;
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->element('pagination'); ?>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>