<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Equipments
        <small>All Equipments List</small>
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
                            class="caption-subject font-green bold uppercase">Equipments</span></h3>
                    <div class="box-tools">
                        <?php echo $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('Add Equipment'), ["action" => "add"], ["class" => "btn btn-block btn-primary", "escape" => false]); ?>
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
                                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('location') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('image') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($equipments) > 0):
                            foreach ($equipments as $equipment): ?>
                            <tr>
                                <td><?= $this->Number->format($equipment->id) ?></td>
                                <td><?= h($equipment->name) ?></td>
                                <td><?= $this->Number->format($equipment->quantity) ?></td>
                                <td><?= h($equipment->location) ?></td>
                                <td><?= h($equipment->image) ?></td>
                                <td><?= $this->Number->format($equipment->status) ?></td>
                                <td><?php if ($equipment->created != "") echo $equipment->created->format('d-M-Y'); ?></td>
                                <td><?php if ($equipment->modified != "") echo $equipment->modified->format('d-M-Y'); ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> View'), ['action' => 'view', $equipment->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                    <?= $this->Html->link(__('<i class="fa fa-edit"></i> Edit'), ['action' => 'edit', $equipment->id], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?>
                                    <?= $this->Form->postLink('<i class="fa fa-trash"></i> Delete', ['action' => 'delete', $equipment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $equipment->id), 'class' => 'btn btn-danger btn-sm', 'escape' => false]) ?>
                                </td>
                            </tr>
                            <?php endforeach;
                            else:
                                echo "<tr> <td colspan='6' align='center'> <strong>No Equipment Found</strong> </td> </tr>";
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