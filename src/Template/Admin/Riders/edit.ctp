<?php
/**
  * @var \App\View\AppView $this
  */
?>

<section class="content-header">
    <h1>
        Manage Staff 
        <small>Update Staff Details</small>
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
            <h3 class="box-title"><?= __('Edit Staff') ?></h3>
        </div><!-- /.box-header -->
        <?php echo $this->Form->create($rider, ['id'=>'validateform','role' => 'form', 'enctype' => 'multipart/form-data']); ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('name', ['class' => 'form-control', 'placeholder' => ucfirst('Name of Staff'), 'label' => ['text' => ucfirst('Name of Staff'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('role_id', ['class' => 'form-control','options'=>$roles ,'placeholder' => ucfirst('Staff Role'), 'label' => ['text' => ucfirst('Staff Role'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('image_file', ['class' => 'form-control','type'=>'file' ,'placeholder' => ucfirst('Image'), 'label' => ['text' => ucfirst('Image'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('country_id', ['class' => 'form-control', 'options' => $countries, 'label' => ['text' => ucfirst('Nationality')]]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('nf_number', ['class' => 'form-control', 'placeholder' => ucfirst('NF Number'), 'label' => ['text' => ucfirst('NF Number'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('eef_licence_number', ['class' => 'form-control', 'placeholder' => ucfirst('EEF Licence Number'), 'label' => ['text' => ucfirst('EEF Licence Number'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('fei_licence_number', ['class' => 'form-control', 'placeholder' => ucfirst('FEI Licence Number'), 'label' => ['text' => ucfirst('FEI Licence Number'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('qualification', ['class' => 'form-control', 'placeholder' => ucfirst('Qualification'), 'label' => ['text' => ucfirst('Qualification'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('noc_status', ['class' => 'form-control', 'options'=>['0'=>'No','1'=>'Yes'] ,'placeholder' => ucfirst('NOC Status'), 'label' => ['text' => ucfirst('NOC Status'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('remarks', ['class' => 'form-control', 'placeholder' => ucfirst('Remarks'), 'label' => ['text' => ucfirst('Remarks'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('status', ['class' => 'form-control','options'=>['0'=>'InActive','1'=>'Active'] ,'placeholder' => ucfirst('status'), 'label' => ['text' => ucfirst('status'),'class'=>'req']]); ?>
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