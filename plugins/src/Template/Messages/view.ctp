<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Messages
        <small>Messages info</small>
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
                            <td><?= $message->has('user') ? $this->Html->link($message->user->name, ['controller' => 'Users', 'action' => 'view', $message->user->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Guardian') ?></th>
                            <td><?= $message->has('guardian') ? $this->Html->link($message->guardian->name, ['controller' => 'Guardians', 'action' => 'view', $message->guardian->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Id') ?></th>
                            <td><?= $this->Number->format($message->id) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Is Read') ?></th>
                            <td><?= $this->Number->format($message->is_read) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                            <td><?= $this->Number->format($message->status) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?= h($message->created) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Message') ?></th>
                            <td><?= $this->Text->autoParagraph(h($message->message)); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>