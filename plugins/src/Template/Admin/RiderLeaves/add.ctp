<?php
/**
  * @var \App\View\AppView $this
  */
?>

<section class="content-header">
    <h1>
        Manage Rider Leaves 
        <small>Create New Rider Leave</small>
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
            <h3 class="box-title"><?= __('Add Rider Leave') ?></h3>
        </div><!-- /.box-header -->
        <?php echo $this->Form->create($riderLeave, ['id'=>'validateform','role' => 'form', 'enctype' => 'multipart/form-data']); ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('rider_id', ['class' => 'form-control', 'options' => $riders, 'label' => ['text' => ucfirst('rider Name')]]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('leave_end_date', ['minYear' => '1990','maxYear' => '2050'],['class' => 'form-control', 'placeholder' => ucfirst('leave_end_date'), 'label' => ['text' => ucfirst('leave_end_date'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('leave_start_date', ['minYear' => '1990','maxYear' => '2050'], ['class' => 'form-control', 'placeholder' => ucfirst('leave_start_date'), 'label' => ['text' => ucfirst('leave_start_date'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('reasons', ['class' => 'form-control', 'placeholder' => ucfirst('reasons'), 'label' => ['text' => ucfirst('reasons'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('status', ['class' => 'form-control','type'=>'select','options'=> ['0'=>'InActive','1'=>'Active'] , 'placeholder' => ucfirst('status'), 'label' => ['text' => ucfirst('status'),'class'=>'req']]); ?>
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