<?php
/**
  * @var \App\View\AppView $this
  */
?>

<section class="content-header">
    <h1>
        Manage Paddocks 
        <small>Create New Paddock</small>
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
            <h3 class="box-title"><?= __('Add Paddock') ?></h3>
        </div><!-- /.box-header -->
        <?php echo $this->Form->create($paddock, ['id'=>'validateform','role' => 'form', 'enctype' => 'multipart/form-data']); ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('horse_id', ['class' => 'form-control', 'options' => $horses, 'label' => ['text' => ucfirst('horse_id')]]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('paddock_number', ['class' => 'form-control', 'placeholder' => ucfirst('paddock_number'), 'label' => ['text' => ucfirst('paddock_number'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('location', ['class' => 'form-control', 'placeholder' => ucfirst('location'), 'label' => ['text' => ucfirst('location'),'class'=>'req']]); ?>
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