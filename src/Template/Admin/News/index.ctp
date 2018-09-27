<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage News
        <small>All News List</small>
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
                    <h3 class="box-title"><i class="fa fa-fw fa-newspaper-o"></i> <span
                            class="caption-subject font-green bold uppercase">News</span></h3>
                    <div class="box-tools">
                        <?php echo $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('Add News'), ["action" => "add"], ["class" => "btn btn-block btn-primary", "escape" => false]); ?>
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
                        <div class="col-md-3">
                            <label for="categories">Categories</label>
                            <?php echo $this->Form->input('category_id', ['type' => 'select', 'class' => 'form-control input-sm pull-right', 'empty' => 'Select Category', 'options' => $categories, 'onchange' => "$('form:first').submit();", 'label' => false, 'value' => !empty($this->request->query['category_id']) ? $this->request->query['category_id'] : '']); ?>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col"><?= $this->Paginator->sort('image') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('category_id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('short_desc') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($news) > 0):
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                            foreach ($news as $news): ?>
                            <tr>
                                <td><?= $this->Number->format($i) ?></td>
                                <td><?php
                                    if (!empty($news->image) && file_exists(WWW_ROOT . "uploads/news/" . $news->image)) {
                                        echo $this->Html->image(_BASE_ . "uploads/news/" . $news->image, ['height' => 55]);
                                    } else {
                                        echo $this->Html->image('no-image.png', ['height' => 55]);
                                    }
                                    ?>
                                </td>
                                <td><?= h($news->category->name) ?></td>
                                <td><?= h($news->title) ?></td>
                                <td><?= substr($news->short_desc, 0, 30) .'<br>'. substr($news->short_desc, 30) ?></td>
                                <td><?php
                                    if ($news->status == 1) echo '<span class="label label-success"> Active </span>';
                                    else echo '<span class="label label-danger"> Inactive </span>'; ?>
                                </td>
                                <td><?php if ($news->modified != "") echo $news->modified->format('d-M-Y'); ?></td>
                                <td><?php if ($news->created != "") echo $news->created->format('d-M-Y'); ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('<i class="fa fa-fw fa-eye"></i>'), ['action' => 'view', $news->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false]) ?>
                                    <?= $this->Html->link(__('<i class="fa fa-edit"></i>'), ['action' => 'add', $news->id], ['class' => 'btn btn-success btn-sm', 'escape' => false]) ?>
                                    <?= $this->Form->postLink('<i class="fa fa-trash"></i>', ['action' => 'delete', $news->id], ['confirm' => __('Are you sure you want to delete # {0}?', $news->id), 'class' => 'btn btn-danger btn-sm', 'escape' => false]) ?>
                                </td>
                            </tr>
                            <?php $i++; 
                            endforeach;
                            else:
                                echo "<tr> <td colspan='9' align='center'> <strong>No News Found</strong> </td> </tr>";
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