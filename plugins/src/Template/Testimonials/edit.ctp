<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $testimonial->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $testimonial->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Testimonials'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="testimonials form large-9 medium-8 columns content">
    <?= $this->Form->create($testimonial) ?>
    <fieldset>
        <legend><?= __('Edit Testimonial') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->input('user_name');
            echo $this->Form->input('title');
            echo $this->Form->input('content');
            echo $this->Form->input('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
