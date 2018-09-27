<?php
/**
  * @var \App\View\AppView $this
  */
?>

<section class="content-header">
    <h1>
        Manage Projects 
        <small>Create New Project</small>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php echo $this->Flash->render(); ?>
        </div>
    </div>
    <!-- SELECT2 EXAMPLE -->
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __('Add Project') ?></h3>
        </div><!-- /.box-header -->
        <?php echo $this->Form->create($project, ['id'=>'validateform','role' => 'form', 'enctype' => 'multipart/form-data']); ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('name', ['class' => 'form-control', 'placeholder' => ucfirst('project name'), 'label' => ['text' => ucfirst('Project name'),'class'=>'req']]); ?>
                    </div>
                </div>
<!--                <div class="col-md-6">
                    <div class="form-group">
                        <?php //echo $this->Form->input('user_id', ['class' => 'form-control', 'options' => $users, 'label' => ['text' => ucfirst('user_id')]]); ?>
                    </div>
                </div>-->
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('status', ['class' => 'form-control', 'options' => ['0'=>'InActive','1'=>'Active'], 'label' => ['text' => ucfirst('status'),'class'=>'req']]); ?>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.box-body -->
        <div class="box-footer">
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
            <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn default']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div><!-- /.box -->
</section>