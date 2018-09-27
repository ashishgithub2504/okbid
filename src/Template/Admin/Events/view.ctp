<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Events
        <small>Events info</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th scope="row"><?= __('Venue') ?></th>
                            <td><?= h($event->venue) ?></td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                            <td><?= ($event->status == 1)?'Active':'InActive' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Date') ?></th>
                            <td><?= h($event->date->format('d-M-Y')) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?= h($event->created->format('d-M-Y')) ?></td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?= __('Event Name') ?></th>
                            <td><?= $this->Text->autoParagraph(h($event->name)); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>