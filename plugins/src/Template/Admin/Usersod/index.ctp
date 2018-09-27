<?php
$user_type = 'Hourse';
?>
<section class="content-header">
    <h1>
        Manage <?= $user_type ?>
        <small>All <?= $user_type ?> List</small>
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
                    <h3 class="box-title"><i class="fa fa-fw fa-users"></i> <span
                            class="caption-subject font-green bold uppercase"><?php echo $user_type; ?></span></h3>

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
                                <th>#</th>
                                <th><?= __('Image') ?></th>
<!--                                <th><?= $this->Paginator->sort('name') ?></th>-->
                                <th><?= $this->Paginator->sort('Hourse Name') ?></th>
<!--                                <th><?= $this->Paginator->sort('Admin') ?></th>
                                <th><?= $this->Paginator->sort('Contact') ?></th>-->
                                <th><?= $this->Paginator->sort('Last Passport Date') ?></th>
                                <th><?= $this->Paginator->sort('Last Vaccine Date') ?></th>
                                
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (count($users) > 0) {

                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                foreach ($users as $record) {
                                    ?>
                                    <tr>
                                        <td><?= $this->Number->format($i) ?></td>
                                        <td><?php
                                            if (!empty($record->profile_pic) && file_exists(WWW_ROOT . "uploads/users/" . $record->profile_pic)) {
                                                echo $this->Html->image(_BASE_ . "uploads/users/" . $record->profile_pic, ['height' => 55]);
                                            } else {
                                                echo $this->Html->image('no-image.png', ['height' => 55]);
                                            }
                                            ?>
                                        </td>
                                        <td><?= h($record->name) ?></td>
<!--                                        <td><?= h($record->username) ?></td>
                                        <td><?= h($record->phone) ?></td>-->
                                        <td>
                                            <?php
                                            if ($record->status == 1) {
                                                echo '<span class="label label-success"> Active </span>';
                                                //echo $this->Html->link('<span class="label label-success"> Active </span>', array('controller' => 'users', 'action' => 'status_change', $record->id, 0), array('escape' => false));
                                            } else {
                                                echo '<span class="label label-danger"> Inactive </span>';
//                                            echo $this->Html->link('<span class="label label-danger"> Inactive </span>', array('controller' => 'users', 'action' => 'status_change', $record->id, 1), array('escape' => false));
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($record->expiry_date != "") {
                                                echo $record->expiry_date->format('d-M-Y');
                                            }
                                            ?>
                                        </td>
                                        <td class="actions">
                                            <div>
                                                <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i> View", ['action' => 'view', $record->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                                <?= $this->Html->link("<i class=\"fa fa-edit\"></i> Edit", ['action' => 'add', $record->id], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?>
                                                <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i> Delete", ['action' => 'delete', $record->id], ['confirm' => __('Are you sure you want to delete # {0}?', $record->name), 'class' => 'btn btn-danger btn-sm', 'escape' => false]) ?>    
                                            </div>
                                        </td>
                                    </tr>

                                    <?php
                                    $i++;
                                }
                            } else {
                                echo "<tr> <td colspan='8' align='center'> <strong>No Users Found</strong> </td> </tr>";
                            }
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