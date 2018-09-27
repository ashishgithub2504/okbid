<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Conversations
        <small>Conversations info</small>
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
                            <td><?= $conversation->has('user') ? $this->Html->link($conversation->user->name, ['controller' => 'Users', 'action' => 'view', $conversation->user->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Title') ?></th>
                            <td><?= h($conversation->title) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Id') ?></th>
                            <td><?= $this->Number->format($conversation->id) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Is Read') ?></th>
                            <td><?= $this->Number->format($conversation->is_read) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                            <td><?= $this->Number->format($conversation->status) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?= h($conversation->created) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Message') ?></th>
                            <td><?= $this->Text->autoParagraph(h($conversation->message)); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>