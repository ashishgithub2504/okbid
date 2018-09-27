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
                            <td><?= $this->Html->image(_BASE_.'/uploads/images/'.$rider->image,array('width'=>'100','class'=>'cursor')) ?></td>
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
                            <th scope="row"><?= __('Noc Status') ?></th>
                            <td><?= ($rider->noc_status == 1)?'Yes':'No'; ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                            <td><?= ($rider->status == 1)?'Active':'InActive'; ?></td>
                        </tr>
                        
                        <tr>
                            <th scope="row"><?= __('Remarks') ?></th>
                            <td><?= $this->Text->autoParagraph(h($rider->remarks)); ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?= h($rider->created->format('d-M-Y')) ?></td>
                        </tr>
                       
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>