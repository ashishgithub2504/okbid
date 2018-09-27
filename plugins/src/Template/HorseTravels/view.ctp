<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Horse Travels
        <small>Horse Travels info</small>
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
                            <td><?= $horseTravel->has('horse') ? $this->Html->link($horseTravel->horse->name, ['controller' => 'Horses', 'action' => 'view', $horseTravel->horse->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Destination') ?></th>
                            <td><?= h($horseTravel->destination) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Id') ?></th>
                            <td><?= $this->Number->format($horseTravel->id) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                            <td><?= $this->Number->format($horseTravel->status) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Travel Date') ?></th>
                            <td><?= h($horseTravel->travel_date) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?= h($horseTravel->created) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Modified') ?></th>
                            <td><?= h($horseTravel->modified) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Reason') ?></th>
                            <td><?= $this->Text->autoParagraph(h($horseTravel->reason)); ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Remark') ?></th>
                            <td><?= $this->Text->autoParagraph(h($horseTravel->remark)); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>