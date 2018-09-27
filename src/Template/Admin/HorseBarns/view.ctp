<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Horse Barns
        <small>Horse Barns info</small>
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
                            <td><?= $horseBarn->has('horse') ? $this->Html->link($horseBarn->horse->name, ['controller' => 'Horses', 'action' => 'view', $horseBarn->horse->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Barn Number') ?></th>
                            <td><?= h($horseBarn->barn_number) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Box Number') ?></th>
                            <td><?= h($horseBarn->box_number) ?></td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                            <td><?= ($horseBarn->status ==1)?'Active':'InActive'; ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?= h($horseBarn->created->format('d-M-Y')) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Modified') ?></th>
                            <td><?= h($horseBarn->modified->format('d-M-Y')) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Remark') ?></th>
                            <td><?= $this->Text->autoParagraph(h($horseBarn->remark)); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>