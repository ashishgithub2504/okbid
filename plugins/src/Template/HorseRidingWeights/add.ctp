<?php
/**
  * @var \App\View\AppView $this
  */
?>

<section class="content-header">
    <h1>
        Manage Horse Riding Weights 
        <small>Create New Horse Riding Weight</small>
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
            <h3 class="box-title"><?= __('Add Horse Riding Weight') ?></h3>
        </div><!-- /.box-header -->
        <?php echo $this->Form->create($horseRidingWeight, ['id'=>'validateform','role' => 'form', 'enctype' => 'multipart/form-data']); ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('horse_id', ['class' => 'form-control', 'options' => $horses, 'label' => ['text' => ucfirst('horse_id')]]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('riding_type', ['class' => 'form-control', 'placeholder' => ucfirst('riding_type'), 'label' => ['text' => ucfirst('riding_type'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('before_weight', ['class' => 'form-control', 'placeholder' => ucfirst('before_weight'), 'label' => ['text' => ucfirst('before_weight'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('after_weight', ['class' => 'form-control', 'placeholder' => ucfirst('after_weight'), 'label' => ['text' => ucfirst('after_weight'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('weight_date', ['class' => 'form-control', 'placeholder' => ucfirst('weight_date'), 'label' => ['text' => ucfirst('weight_date'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('remark', ['class' => 'form-control', 'placeholder' => ucfirst('remark'), 'label' => ['text' => ucfirst('remark'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('status', ['class' => 'form-control', 'placeholder' => ucfirst('status'), 'label' => ['text' => ucfirst('status'),'class'=>'req']]); ?>
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