<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Newsletters
        <small>All Newsletters List</small>
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
                            class="caption-subject font-green bold uppercase">Newsletters</span></h3>
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
                                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($newsletters as $newsletter): ?>
                            <tr>
                                <td><?= $this->Number->format($newsletter->id) ?></td>
                                <td><?= h($newsletter->email) ?></td>
                                <td><?= $this->Number->format($newsletter->status) ?></td>
                                <td><?= h($newsletter->created) ?></td>
                                <td class="actions">
                                <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i> View'), ['action' => 'view', $newsletter->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                <?= $this->Html->link(__('<i class="fa fa-edit"></i> Edit'), ['action' => 'edit', $newsletter->id], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?>
                                <?= $this->Form->postLink('<i class="fa fa-trash"></i> Delete', ['action' => 'delete', $newsletter->id], ['confirm' => __('Are you sure you want to delete # {0}?', $newsletter->id), 'class' => 'btn btn-danger btn-sm', 'escape' => false]) ?>
                            </td>
                            </tr>
                            <?php endforeach; ?>
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