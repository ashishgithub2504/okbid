<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage News
        <small>News info</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th scope="row"><?= __('Id') ?></th>
                            <td>#<?= $this->Number->format($news->id) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Category') ?></th>
                            <td><?= h($news->category->name) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Title') ?></th>
                            <td><?= h($news->title) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Short Desc') ?></th>
                            <td><?= h($news->short_desc) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Image') ?></th>
                            <td>
                                <?php
                                if (!empty($news->image) && file_exists(WWW_ROOT . "uploads/news/" . $news->image)) {

                                    echo $this->Html->image(_BASE_ . "uploads/news/" . $news->image, ['width' => 150, 'height' => 130]);
                                } else {
                                    echo $this->Html->image('no-image.png', ['width' => 150, 'height' => 130]);
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                            <td><?php
                                if ($news->status == 1) {
                                    echo '<span class="label label-success"> Active </span>';
                                } else {
                                    echo '<span class="label label-danger"> Inactive </span>';
                                }
                                ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Modified') ?></th>
                            <td><?php if ($news->modified != "") echo $news->modified->format('d-M-Y H:i'); ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?php if ($news->created != "") echo $news->created->format('d-M-Y H:i'); ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Description') ?></th>
                            <td><?= $this->Text->autoParagraph(h($news->description)); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>