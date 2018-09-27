<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Childs
        <small>Childs info</small>
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
                            <td><?= $child->has('user') ? $this->Html->link($child->user->name, ['controller' => 'Users', 'action' => 'view', $child->user->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Name') ?></th>
                            <td><?= h($child->name) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Id') ?></th>
                            <td><?= $this->Number->format($child->id) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                            <td><?= $this->Number->format($child->status) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Dob') ?></th>
                            <td><?= h($child->dob) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?= h($child->created) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Modified') ?></th>
                            <td><?= h($child->modified) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>