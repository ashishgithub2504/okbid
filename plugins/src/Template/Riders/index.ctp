<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Riders
        <small>All Riders List</small>
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
                            class="caption-subject font-green bold uppercase">Riders</span></h3>
                    <div class="box-tools">
                        <?php echo $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('Add Rider'), ["action" => "add"], ["class" => "btn btn-block btn-primary", "escape" => false]); ?>
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
                                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('image') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('country_id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('nf_number') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('eef_licence_number') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('fei_licence_number') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('qualification') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('noc_status') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($riders) > 0):
                            foreach ($riders as $rider): ?>
                            <tr>
                                <td><?= $this->Number->format($rider->id) ?></td>
                                <td><?= h($rider->name) ?></td>
                                <td><?= h($rider->image) ?></td>
                                <td><?= $rider->has('country') ? $this->Html->link($rider->country->name, ['controller' => 'Countries', 'action' => 'view', $rider->country->id]) : '' ?></td>
                                <td><?= h($rider->nf_number) ?></td>
                                <td><?= h($rider->eef_licence_number) ?></td>
                                <td><?= h($rider->fei_licence_number) ?></td>
                                <td><?= h($rider->qualification) ?></td>
                                <td><?= $this->Number->format($rider->noc_status) ?></td>
                                <td><?= $this->Number->format($rider->status) ?></td>
                                <td><?php if ($rider->created != "") echo $rider->created->format('d-M-Y'); ?></td>
                                <td><?php if ($rider->modified != "") echo $rider->modified->format('d-M-Y'); ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> View'), ['action' => 'view', $rider->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                    <?= $this->Html->link(__('<i class="fa fa-edit"></i> Edit'), ['action' => 'edit', $rider->id], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?>
                                    <?= $this->Form->postLink('<i class="fa fa-trash"></i> Delete', ['action' => 'delete', $rider->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rider->id), 'class' => 'btn btn-danger btn-sm', 'escape' => false]) ?>
                                </td>
                            </tr>
                            <?php endforeach;
                            else:
                                echo "<tr> <td colspan='6' align='center'> <strong>No Rider Found</strong> </td> </tr>";
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