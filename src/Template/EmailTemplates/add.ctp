<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Email Templates'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="emailTemplates form large-9 medium-8 columns content">
    <?= $this->Form->create($emailTemplate) ?>
    <fieldset>
        <legend><?= __('Add Email Template') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('subject');
            echo $this->Form->input('description');
            echo $this->Form->input('status');
            echo $this->Form->input('is_html');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
