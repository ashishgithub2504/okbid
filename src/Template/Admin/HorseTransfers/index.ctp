<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Horse Transfers
        <small>All Horse Transfers List</small>
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
                            class="caption-subject font-green bold uppercase">Horse Transfers</span></h3>
                    <div class="box-tools">
                        <?php echo $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('Add Horse Transfer'), ["action" => "add"], ["class" => "btn btn-block btn-primary", "escape" => false]); ?>
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
                                <th scope="col"><?= $this->Paginator->sort('transfer_date') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('arrival') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('departure') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('stable_name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('person_name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($horseTransfers) > 0):
                            foreach ($horseTransfers as $horseTransfer): ?>
                            <tr>
                                <td><?= $this->Number->format($horseTransfer->id) ?></td>
                                <td><?= $horseTransfer->has('horse') ? $this->Html->link($horseTransfer->horse->name, ['controller' => 'Horses', 'action' => 'view', $horseTransfer->horse->id]) : '' ?></td>
                                <td><?= h($horseTransfer->transfer_date->format('d-m-Y')) ?></td>
                                <td><?= h($horseTransfer->arrival) ?></td>
                                <td><?= h($horseTransfer->departure) ?></td>
                                <td><?= h($horseTransfer->stable_name) ?></td>
                                <td><?= h($horseTransfer->person_name) ?></td>
                                <td><?= ($horseTransfer->status == 1)?'Active':'InActive'; ?></td>
                                <td><?php if ($horseTransfer->created != "") echo $horseTransfer->created->format('d-M-Y'); ?></td>
                                <td><?php if ($horseTransfer->modified != "") echo $horseTransfer->modified->format('d-M-Y'); ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> View'), ['action' => 'view', $horseTransfer->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                    <?= $this->Html->link(__('<i class="fa fa-edit"></i> Edit'), ['action' => 'edit', $horseTransfer->id], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?>
                                    <?= $this->Form->postLink('<i class="fa fa-trash"></i> Delete', ['action' => 'delete', $horseTransfer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $horseTransfer->id), 'class' => 'btn btn-danger btn-sm', 'escape' => false]) ?>
                                </td>
                            </tr>
                            <?php endforeach;
                            else:
                                echo "<tr> <td colspan='6' align='center'> <strong>No Horse Transfer Found</strong> </td> </tr>";
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