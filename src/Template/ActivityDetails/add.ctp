<?php
/**
  * @var \App\View\AppView $this
  */
?>

<section class="content-header">
    <h1>
        Manage Activity Details 
        <small>Create New Activity Detail</small>
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
            <h3 class="box-title"><?= __('Add Activity Detail') ?></h3>
        </div><!-- /.box-header -->
        <?php echo $this->Form->create($activityDetail, ['id'=>'validateform','role' => 'form', 'enctype' => 'multipart/form-data']); ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('activity_id', ['class' => 'form-control', 'options' => $activities, 'label' => ['text' => ucfirst('activity_id')]]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('category_id', ['class' => 'form-control', 'options' => $categories, 'label' => ['text' => ucfirst('category_id')]]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('input', ['class' => 'form-control', 'placeholder' => ucfirst('input'), 'label' => ['text' => ucfirst('input'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('output', ['class' => 'form-control', 'placeholder' => ucfirst('output'), 'label' => ['text' => ucfirst('output'),'class'=>'req']]); ?>
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