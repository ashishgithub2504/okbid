<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Horse Transfers
        <small>Horse Transfers info</small>
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
                            <td><?= $horseTransfer->has('horse') ? $this->Html->link($horseTransfer->horse->name, ['controller' => 'Horses', 'action' => 'view', $horseTransfer->horse->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Arrival') ?></th>
                            <td><?= h($horseTransfer->arrival) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Departure') ?></th>
                            <td><?= h($horseTransfer->departure) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Stable Name') ?></th>
                            <td><?= h($horseTransfer->stable_name) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Person Name') ?></th>
                            <td><?= h($horseTransfer->person_name) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Id') ?></th>
                            <td><?= $this->Number->format($horseTransfer->id) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                            <td><?= $this->Number->format($horseTransfer->status) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Transfer Date') ?></th>
                            <td><?= h($horseTransfer->transfer_date) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?= h($horseTransfer->created) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Modified') ?></th>
                            <td><?= h($horseTransfer->modified) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Remark') ?></th>
                            <td><?= $this->Text->autoParagraph(h($horseTransfer->remark)); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>