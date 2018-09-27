<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Horse Performances
        <small>Horse Performances info</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th scope="row"><?= __('Horse') ?></th>
                            <td><?= $horsePerformance->has('horse') ? $this->Html->link($horsePerformance->horse->name, ['controller' => 'Horses', 'action' => 'view', $horsePerformance->horse->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('User') ?></th>
                            <td><?= $horsePerformance->has('user') ? $this->Html->link($horsePerformance->user->name, ['controller' => 'Users', 'action' => 'view', $horsePerformance->user->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Sponsor') ?></th>
                            <td><?= h($horsePerformance->sponsor) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Place') ?></th>
                            <td><?= h($horsePerformance->place) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Where') ?></th>
                            <td><?= h($horsePerformance->where) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Reason') ?></th>
                            <td><?= h($horsePerformance->reason) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Id') ?></th>
                            <td><?= $this->Number->format($horsePerformance->id) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                            <td><?= $this->Number->format($horsePerformance->status) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Running Date') ?></th>
                            <td><?= h($horsePerformance->running_date) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?= h($horsePerformance->created) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Modified') ?></th>
                            <td><?= h($horsePerformance->modified) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Remark') ?></th>
                            <td><?= $this->Text->autoParagraph(h($horsePerformance->remark)); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>