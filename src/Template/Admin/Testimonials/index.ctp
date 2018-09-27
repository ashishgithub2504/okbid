<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Testimonials
        <small>All Testimonials List</small>
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
                    <h3 class="box-title"><i class="fa fa-fw fa-edit"></i> <span
                            class="caption-subject font-green bold uppercase">Testimonials</span></h3>

                    <div class="box-tools">
                        <?php echo $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('Add Testimonial'), ["action" => "add"], ["class" => "btn btn-block btn-primary", "escape" => false]); ?>
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
                                <th><?= __('User Name') ?></th>
                                <th><?= $this->Paginator->sort('title') ?></th>
                                <th><?= $this->Paginator->sort('status') ?></th>
                                <th><?= $this->Paginator->sort('created', 'Add Date') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (count($testimonials) > 0) {
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                foreach ($testimonials as $record) {
                                    ?>
                                    <tr>
                                        <td><?= $this->Number->format($i) ?></td>
                                        <td><?php
                                            if($record->user_id == 0) echo $record->user_name;
                                            else echo $this->Html->link($record->user->name,['controller' => 'users', 'action' => 'view', $record->user->id]); ?>
                                        </td>
                                        <td><?= h($record->title) ?></td>
                                        <td><?php
                                            if ($record->status == 1) echo '<span class="label label-success"> Approved </span>';
                                            else echo '<span class="label label-danger"> Not Approved </span>'; ?>
                                        </td>
                                        <td><?php
                                            if ($record->created != "") echo $record->created->format('d-M-Y'); ?>
                                        </td>
                                        <td class="actions" width="30%">
                                            <div>
                                                <?php if ($record->status == 0) 
                                                    echo  $this->Html->link("<i class=\"fa fa-check\"></i> &nbsp; Approve &nbsp;&nbsp; ", 'javascript::void(0);', ['onclick' => 'changeStatus(this)', 'record_id' => $record->id, 'status' => 1, 'class' => 'btn btn-success btn-sm', 'escape' => false]);
                                                else    
                                                    echo  $this->Html->link("<i class=\"fa fa-times\"></i> Disapprove", 'javascript::void(0);', ['onclick' => 'changeStatus(this)', 'record_id' => $record->id, 'status' => 0, 'class' => 'btn btn-danger btn-sm', 'escape' => false]); ?>
                                                <?= $this->Html->link("<i class=\"fa fa-edit\"></i> Edit", ['action' => 'add', $record->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                                <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i> Delete", ['action' => 'delete', $record->id], ['confirm' => __('Are you sure you want to delete # {0}?', $record->name), 'class' => 'btn btn-danger btn-sm', 'escape' => false]) ?>    
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            } else {
                                echo "<tr> <td colspan='6' align='center'> <strong>No Testimonials Found</strong> </td> </tr>";
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
<script type="text/javascript">
    <?php $this->Html->scriptStart(['block' => true]); ?>

    function changeStatus(obj) {
        var id = $(obj).attr('record_id');
        var status = $(obj).attr('status');
        $.ajax({
            dataType: 'json',
            type: "POST",
            url: '<?= _BASE_ ?>admin/testimonials/changeStatus/' + id + '?status=' + status,
            success: function (response) {
                    location.reload();
            }
        });
    }

    <?php $this->Html->scriptEnd(); ?>
</script>

