<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Horse Performances
        <small>All Horse Performances List</small>
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
                            class="caption-subject font-green bold uppercase">Horse Performances</span></h3>
                    <div class="box-tools">
                        <?php echo $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('Add Horse Performance'), ["action" => "add"], ["class" => "btn btn-block btn-primary", "escape" => false]); ?>
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
                                <th scope="col"><?= $this->Paginator->sort('horse_id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('running_date') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('sponsor') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('place') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('where') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('reason') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($horsePerformances) > 0):
                            foreach ($horsePerformances as $horsePerformance): ?>
                            <tr>
                                <td><?= $this->Number->format($horsePerformance->id) ?></td>
                                <td><?= $horsePerformance->has('horse') ? $this->Html->link($horsePerformance->horse->name, ['controller' => 'Horses', 'action' => 'view', $horsePerformance->horse->id]) : '' ?></td>
                                <td><?= $horsePerformance->has('user') ? $this->Html->link($horsePerformance->user->name, ['controller' => 'Users', 'action' => 'view', $horsePerformance->user->id]) : '' ?></td>
                                <td><?= h($horsePerformance->running_date) ?></td>
                                <td><?= h($horsePerformance->sponsor) ?></td>
                                <td><?= h($horsePerformance->place) ?></td>
                                <td><?= h($horsePerformance->where) ?></td>
                                <td><?= h($horsePerformance->reason) ?></td>
                                <td><?= $this->Number->format($horsePerformance->status) ?></td>
                                <td><?php if ($horsePerformance->created != "") echo $horsePerformance->created->format('d-M-Y'); ?></td>
                                <td><?php if ($horsePerformance->modified != "") echo $horsePerformance->modified->format('d-M-Y'); ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> View'), ['action' => 'view', $horsePerformance->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                    <?= $this->Html->link(__('<i class="fa fa-edit"></i> Edit'), ['action' => 'edit', $horsePerformance->id], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?>
                                    <?= $this->Form->postLink('<i class="fa fa-trash"></i> Delete', ['action' => 'delete', $horsePerformance->id], ['confirm' => __('Are you sure you want to delete # {0}?', $horsePerformance->id), 'class' => 'btn btn-danger btn-sm', 'escape' => false]) ?>
                                </td>
                            </tr>
                            <?php endforeach;
                            else:
                                echo "<tr> <td colspan='6' align='center'> <strong>No Horse Performance Found</strong> </td> </tr>";
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