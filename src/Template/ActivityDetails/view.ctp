<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Activity Details
        <small>Activity Details info</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th scope="row"><?= __('Activity') ?></th>
                            <td><?= $activityDetail->has('activity') ? $this->Html->link($activityDetail->activity->id, ['controller' => 'Activities', 'action' => 'view', $activityDetail->activity->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Category') ?></th>
                            <td><?= $activityDetail->has('category') ? $this->Html->link($activityDetail->category->name, ['controller' => 'Categories', 'action' => 'view', $activityDetail->category->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Input') ?></th>
                            <td><?= h($activityDetail->input) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Output') ?></th>
                            <td><?= h($activityDetail->output) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Id') ?></th>
                            <td><?= $this->Number->format($activityDetail->id) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>