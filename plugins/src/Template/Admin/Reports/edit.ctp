<?php
/**
  * @var \App\View\AppView $this
  */
?>

<section class="content-header">
    <h1>
        Manage Reports 
        <small>Update Report Details</small>
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
            <h3 class="box-title"><?= __('Edit Report') ?></h3>
        </div><!-- /.box-header -->
        <?php echo $this->Form->create($report, ['id'=>'validateform','role' => 'form', 'enctype' => 'multipart/form-data']); ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('fei_number', ['class' => 'form-control', 'placeholder' => ucfirst('fei_number'), 'label' => ['text' => ucfirst('fei_number'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('eef_number', ['class' => 'form-control', 'placeholder' => ucfirst('eef_number'), 'label' => ['text' => ucfirst('eef_number'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('chipid', ['class' => 'form-control', 'placeholder' => ucfirst('chipid'), 'label' => ['text' => ucfirst('chipid'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('birth_name', ['class' => 'form-control', 'placeholder' => ucfirst('birth_name'), 'label' => ['text' => ucfirst('birth_name'),'class'=>'req']]); ?>
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