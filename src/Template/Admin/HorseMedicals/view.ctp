<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Horse Medicals
        <small>Horse Medicals info</small>
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
                            <td><?= $horseMedical->has('horse') ? $this->Html->link($horseMedical->horse->name, ['controller' => 'Horses', 'action' => 'view', $horseMedical->horse->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                            <td><?= ($horseMedical->status == 1)?'Active':'Inactive'; ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Date') ?></th>
                            <td><?= h($horseMedical->date->format('d-M-Y')) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?= h($horseMedical->created->format('d-M-Y')) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Modified') ?></th>
                            <td><?= h($horseMedical->modified->format('d-M-Y')) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Remark') ?></th>
                            <td><?= $this->Text->autoParagraph(h($horseMedical->remark)); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>