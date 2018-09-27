<?php
echo $this->Form->create(false, ['type' => 'get', 'id' => 'filterForm', 'role' => 'form', 'inputDefaults' => ['div' => false, 'label' => false]]);
?>
<section class="content-header">
    <h1>
        Manage Content <small>All cms pages</small>
    </h1>
    <?php //echo $this->element('breadcrumb', array('pageName' => $this->request->params['controller'])); ?>
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
                    <h3 class="box-title"><i class="fa fa-fw fa-file-o"></i> <span class="caption-subject font-green bold uppercase"><?php echo __('Pages') ?></span></h3>
                    <div class="box-tools">
                        <?php echo $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('Add Page'), ["action" => "add"], ["class" => "btn btn-block btn-primary", "escape" => false]); ?>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="keyword">Keyword</label>
                            <div class="input-group">
                                <?php echo $this->Form->input('keyword', ['class' => 'form-control input-sm pull-right', 'placeholder' => 'Keyword', 'label' => false, 'value' => !empty($this->request->query['keyword']) ? $this->request->query['keyword'] : '']); ?>
                                <div class="input-group-btn">
                                    <?php echo $this->Form->button('<i class="fa fa-search"></i>', ['class' => 'btn btn-sm btn-default', 'type' => 'Submit', 'escape' => false]); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?= $this->Paginator->sort('title') ?></th>
                                <th>Page URL</th>
                                <th><?= $this->Paginator->sort('status') ?></th>
                                <th><?= $this->Paginator->sort('created', 'Add Date') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($records)) {
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                foreach ($records as $record) {
                                    ?>
                                    <tr>
                                        <td><?= $this->Number->format($i) ?></td>
                                        <td><?= h($record->title) ?></td>
                                        <td><?= h($record->alias) ?></td>
                                        <td>
                                           <?php
                                            if ($record->status == 1) {
                                                echo '<span class="label label-success"> Active </span>';
                                            } else {
                                                echo '<span class="label label-danger"> Inactive </span>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($record->created != "") {
                                                echo $record->created->format('d-M-Y');
                                            }
                                            ?>
                                        </td>
                                        <td class="actions" width="13%">
                                            <div>
                                                <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i> View", ['action' => 'view', $record->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]); ?>
                                                <?= $this->Html->link("<i class=\"fa fa-edit\"></i> Edit", ['action' => 'add', $record->id], ['class' => 'btn btn-success btn-sm', 'escape' => false]); ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <?php
                                    $i++;
                                }
                            } else {
                                echo "<tr> <td colspan='6' align='center'> <strong>Record Not Available</strong> </td> </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->element('pagination'); ?>
                </div>
            </div><!-- /.box -->
        </div>
    </div>
</section>
<?= $this->Form->end() ?>