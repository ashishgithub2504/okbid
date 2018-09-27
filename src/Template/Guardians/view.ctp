<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Guardians
        <small>Guardians info</small>
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
                            <td><?= h($guardian->name) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Profile Pic') ?></th>
                            <td><?= h($guardian->profile_pic) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Relationship') ?></th>
                            <td><?= h($guardian->relationship) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Email') ?></th>
                            <td><?= h($guardian->email) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Id') ?></th>
                            <td><?= $this->Number->format($guardian->id) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Child Id') ?></th>
                            <td><?= $this->Number->format($guardian->child_id) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Mobile') ?></th>
                            <td><?= $this->Number->format($guardian->mobile) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Home Nmber') ?></th>
                            <td><?= $this->Number->format($guardian->home_nmber) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                            <td><?= $this->Number->format($guardian->status) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?= h($guardian->created) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Modified') ?></th>
                            <td><?= h($guardian->modified) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Address') ?></th>
                            <td><?= $this->Text->autoParagraph(h($guardian->address)); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>