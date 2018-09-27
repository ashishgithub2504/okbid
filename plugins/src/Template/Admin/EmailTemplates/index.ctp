<?php
use Cake\Core\Configure;
echo $this->Form->create(false, ['type' => 'get', 'id' => 'filterForm', 'role' => 'form', 'inputDefaults' => ['div' => false, 'label' => false]]);
?>
<section class="content-header">
    <h1>
        Manage Email Templates <small>All Templates</small>
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
                    <h3 class="box-title"><i class="fa fa-fw fa-envelope"></i> <span class="caption-subject font-green bold uppercase"><?php echo __('Templates') ?></span></h3>
                    <div class="box-tools">
                        <?php echo $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('Add Template'), ["action" => "add"], ["class" => "btn btn-block btn-primary", "escape" => false]); ?>
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
                                <th><?= $this->Paginator->sort('subject') ?></th>
                                <th><?= $this->Paginator->sort('status') ?></th>
                                <th><?= $this->Paginator->sort('is_html') ?></th>
                                <th><?= $this->Paginator->sort('created') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($records)) {
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                foreach ($records as $record):
                                    ?>
                                    <tr>
                                        <td><?= $this->Number->format($i) ?></td>
                                        <td><?= h($record->title) ?></td>
                                        <td><?= h($record->subject) ?></td>
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
                                            if ($record->is_html == 1) {
                                                echo '<span class="label label-success"> YES </span>';
                                            } else {
                                                echo '<span class="label label-danger"> NO </span>';
                                            }
                                            ?>
                                        </td> 
                                        <td>
                                            <?php
                                            if ($record->created != "") {
                                                echo $record->created->format($SettingConfig['admin_date_format']);
                                            }
                                            ?>
                                        </td>
                                        <td class="actions">
                                            <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i> ", ['action' => 'view', $record->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                            <?= $this->Html->link("<i class=\"fa fa-edit\"></i> ", ['action' => 'add', $record->id], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                endforeach;
                            } else {

                                echo "<tr> <td colspan='10' align='center'> <strong>Record Not Available</strong> </td> </tr>";
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