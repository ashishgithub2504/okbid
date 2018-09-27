<?php
/**
  * @var \App\View\AppView $this
  */
use Cake\Core\Configure;
$roles = ['1'=>'buyer','2'=>'Seller','3'=>'Leader','4'=>'Agent','5'=>'Manager','6'=>'Building contractor'];
?>
<section class="content-header">
    <h1>
        Manage Property Commisions
        <small>All Property Commisions List</small>
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
                            class="caption-subject font-green bold uppercase">Property Commisions</span></h3>
                    <div class="box-tools">
                        <?php echo $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('Add Property Commision'), ["action" => "add"], ["class" => "btn btn-block btn-primary", "escape" => false]); ?>
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
                                <th scope="col"><?= $this->Paginator->sort('category') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('sub_category') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('Role','User') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('Created By') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('commision','Commision in Percentage') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($propertyCommisions) > 0):
                            foreach ($propertyCommisions as $propertyCommision): ?>
                            <tr>
                                <td><?= $this->Number->format($propertyCommision->id) ?></td>
                                <td><?= Configure::read('CATEGORY' . LAN)[$propertyCommision->category]; ?></td>
                                <td><?= h($propertyCommision->sub_category) ?></td>
                                <td><?= isset($propertyCommision->role_id)?$roles[$propertyCommision->role_id]:''; ?></td>
                                <td><?= h($propertyCommision->user->name) ?></td>
                                <td><?= $this->Number->format($propertyCommision->commision) ?></td>
                                <td><?= ($propertyCommision->status == 1)? 'Active':'Inactive'; ?></td>
                                <td><?php if ($propertyCommision->created != "") echo $propertyCommision->created->format('d-M-Y'); ?></td>
                                <td><?php if ($propertyCommision->modified != "") echo $propertyCommision->modified->format('d-M-Y'); ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> View'), ['action' => 'view', $propertyCommision->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                    <?= $this->Html->link(__('<i class="fa fa-edit"></i> Edit'), ['action' => 'edit', $propertyCommision->id], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?>
                                    <?= $this->Form->postLink('<i class="fa fa-trash"></i> Delete', ['action' => 'delete', $propertyCommision->id], ['confirm' => __('Are you sure you want to delete # {0}?', $propertyCommision->id), 'class' => 'btn btn-danger btn-sm', 'escape' => false]) ?>
                                </td>
                            </tr>
                            <?php endforeach;
                            else:
                                echo "<tr> <td colspan='6' align='center'> <strong>No Property Commision Found</strong> </td> </tr>";
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