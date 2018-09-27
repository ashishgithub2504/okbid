<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Activities
        <small>Activities info</small>
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
                            <td><?= $this->Number->format($activity->id) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Child Id') ?></th>
                            <td><?= $this->Number->format($activity->child_id) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                            <td><?= $this->Number->format($activity->status) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Date') ?></th>
                            <td><?= h($activity->date) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?= h($activity->created) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Modified') ?></th>
                            <td><?= h($activity->modified) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>