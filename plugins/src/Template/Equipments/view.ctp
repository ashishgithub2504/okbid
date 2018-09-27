<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Equipments
        <small>Equipments info</small>
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
                            <td><?= h($equipment->name) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Location') ?></th>
                            <td><?= h($equipment->location) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Image') ?></th>
                            <td><?= h($equipment->image) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Id') ?></th>
                            <td><?= $this->Number->format($equipment->id) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Quantity') ?></th>
                            <td><?= $this->Number->format($equipment->quantity) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                            <td><?= $this->Number->format($equipment->status) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?= h($equipment->created) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Modified') ?></th>
                            <td><?= h($equipment->modified) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Remark') ?></th>
                            <td><?= $this->Text->autoParagraph(h($equipment->remark)); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>