<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->input('auth_token');
            echo $this->Form->input('name');
            echo $this->Form->input('email');
            echo $this->Form->input('role_id', ['options' => $roles]);
            echo $this->Form->input('username');
            echo $this->Form->input('password');
            echo $this->Form->input('phone');
            echo $this->Form->input('age');
            echo $this->Form->input('gender');
            echo $this->Form->input('profile_pic');
            echo $this->Form->input('online_status');
            echo $this->Form->input('verification_code');
            echo $this->Form->input('reset_key');
            echo $this->Form->input('unique_key');
            echo $this->Form->input('login_by');
            echo $this->Form->input('device_id');
            echo $this->Form->input('device_type');
            echo $this->Form->input('last_login', ['empty' => true]);
            echo $this->Form->input('is_verified');
            echo $this->Form->input('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
