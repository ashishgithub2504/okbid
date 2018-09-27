<?php
/**
  * @var \App\View\AppView $this
  */
?>

<section class="content-header">
    <h1>
        Manage Horses 
        <small>Update Horse Details</small>
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
            <h3 class="box-title"><?= __('Edit Horse') ?></h3>
        </div><!-- /.box-header -->
        <?php echo $this->Form->create($horse, ['id'=>'validateform','role' => 'form', 'enctype' => 'multipart/form-data']); ?>
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
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('name', ['class' => 'form-control', 'placeholder' => ucfirst('name'), 'label' => ['text' => ucfirst('name'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('image', ['class' => 'form-control', 'placeholder' => ucfirst('image'), 'label' => ['text' => ucfirst('image'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('dob', ['class' => 'form-control', 'placeholder' => ucfirst('dob'), 'label' => ['text' => ucfirst('dob'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('height', ['class' => 'form-control', 'placeholder' => ucfirst('height'), 'label' => ['text' => ucfirst('height'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('sire', ['class' => 'form-control', 'placeholder' => ucfirst('sire'), 'label' => ['text' => ucfirst('sire'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('dam', ['class' => 'form-control', 'placeholder' => ucfirst('dam'), 'label' => ['text' => ucfirst('dam'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('gender', ['class' => 'form-control', 'placeholder' => ucfirst('gender'), 'label' => ['text' => ucfirst('gender'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('color', ['class' => 'form-control', 'placeholder' => ucfirst('color'), 'label' => ['text' => ucfirst('color'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('breed', ['class' => 'form-control', 'placeholder' => ucfirst('breed'), 'label' => ['text' => ucfirst('breed'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('country_birth', ['class' => 'form-control', 'placeholder' => ucfirst('country_birth'), 'label' => ['text' => ucfirst('country_birth'),'class'=>'req']]); ?>
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