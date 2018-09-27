<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Rider Documents
        <small>Rider Documents info</small>
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
                            <td><?= $riderDocument->has('rider') ? $this->Html->link($riderDocument->rider->name, ['controller' => 'Riders', 'action' => 'view', $riderDocument->rider->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Document') ?></th>
                            <td><?= h($riderDocument->document) ?></td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                            <td><?= ($riderDocument->status == 1)?'Active':'InActive'; ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?= h($riderDocument->created) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Modified') ?></th>
                            <td><?= h($riderDocument->modified) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Remark') ?></th>
                            <td><?= $this->Text->autoParagraph(h($riderDocument->remark)); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>