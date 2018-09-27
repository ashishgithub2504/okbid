<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Images
        <small>Images info</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th scope="row"><?= __('Title') ?></th>
                            <td><?= h($image->title) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Image') ?></th>
                            <td><?= h($image->image) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Id') ?></th>
                            <td><?= $this->Number->format($image->id) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Type') ?></th>
                            <td><?= $this->Number->format($image->type) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                            <td><?= $this->Number->format($image->status) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Modified') ?></th>
                            <td><?= h($image->modified) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?= h($image->created) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>