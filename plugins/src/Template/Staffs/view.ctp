<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Staffs
        <small>Staffs info</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th scope="row"><?= __('User') ?></th>
                            <td><?= $staff->has('user') ? $this->Html->link($staff->user->name, ['controller' => 'Users', 'action' => 'view', $staff->user->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Name') ?></th>
                            <td><?= h($staff->name) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Email') ?></th>
                            <td><?= h($staff->email) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Id') ?></th>
                            <td><?= $this->Number->format($staff->id) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Mobile') ?></th>
                            <td><?= $this->Number->format($staff->mobile) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?= h($staff->created) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Modified') ?></th>
                            <td><?= h($staff->modified) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Address') ?></th>
                            <td><?= $this->Text->autoParagraph(h($staff->address)); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>