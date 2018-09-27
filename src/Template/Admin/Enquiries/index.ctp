<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Enquiries
        <small>All Enquiries List</small>
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
                    <h3 class="box-title"><i class="fa fa-fw  fa-question-circle"></i> <span
                            class="caption-subject font-green bold uppercase">Enquiries</span></h3>
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
                                <th><?= __('Name') ?></th>
                                <th><?= __('Email') ?></th>
                                <th><?= __('Phone') ?></th>
                                <th><?= $this->Paginator->sort('created', 'Add Date') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (count($enquiries) > 0) {
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                foreach ($enquiries as $record) {
                                    ?>
                                    <tr>
                                        <td><?= $this->Number->format($i) ?></td>
                                        <td><?= $record->name ?></td>
                                        <td><?= h($record->email) ?></td>
                                        <td><?= h($record->phone) ?></td>
                                        <td><?php
                                            if ($record->created != "") echo $record->created->format('d-M-Y'); ?>
                                        </td>
                                        <td class="actions">
                                            <div>
                                                <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i> View", ['action' => 'view', $record->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                                <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i> Delete", ['action' => 'delete', $record->id], ['confirm' => __('Are you sure you want to delete # {0}?', $record->name), 'class' => 'btn btn-danger btn-sm', 'escape' => false]) ?>    
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            } else {
                                echo "<tr> <td colspan='6' align='center'> <strong>No Enquiries Found</strong> </td> </tr>";
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