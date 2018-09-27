<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Riders
        <small>Riders info</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th scope="row"><?= __('Name') ?></th>
                            <td><?= h($rider->name) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Image') ?></th>
                            <td><?= h($rider->image) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Country') ?></th>
                            <td><?= $rider->has('country') ? $this->Html->link($rider->country->name, ['controller' => 'Countries', 'action' => 'view', $rider->country->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Nf Number') ?></th>
                            <td><?= h($rider->nf_number) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Eef Licence Number') ?></th>
                            <td><?= h($rider->eef_licence_number) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Fei Licence Number') ?></th>
                            <td><?= h($rider->fei_licence_number) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Qualification') ?></th>
                            <td><?= h($rider->qualification) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Id') ?></th>
                            <td><?= $this->Number->format($rider->id) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Noc Status') ?></th>
                            <td><?= $this->Number->format($rider->noc_status) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                            <td><?= $this->Number->format($rider->status) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?= h($rider->created) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Modified') ?></th>
                            <td><?= h($rider->modified) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Remarks') ?></th>
                            <td><?= $this->Text->autoParagraph(h($rider->remarks)); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>