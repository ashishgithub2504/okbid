<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Rider Leaves
        <small>Rider Leaves info</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th scope="row"><?= __('Rider') ?></th>
                            <td><?= $riderLeave->has('rider') ? $this->Html->link($riderLeave->rider->name, ['controller' => 'Riders', 'action' => 'view', $riderLeave->rider->id]) : '' ?></td>
                        </tr>
                        
                        
                        <tr>
                            <th scope="row"><?= __('Leave End Date') ?></th>
                            <td><?= h($riderLeave->leave_end_date->format('d-M-Y')) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Leave Start Date') ?></th>
                            <td><?= h($riderLeave->leave_start_date->format('d-M-Y')) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                            <td><?= ($riderLeave->status == 1)?'Active':'InActive'; ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?= h($riderLeave->created) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Modified') ?></th>
                            <td><?= h($riderLeave->modified) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Reasons') ?></th>
                            <td><?= $this->Text->autoParagraph(h($riderLeave->reasons)); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>