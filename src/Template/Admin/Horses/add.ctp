<?php
/**
  * @var \App\View\AppView $this
  */
use Cake\Core\Configure;
?>

<section class="content-header">
    <h1>
        Manage Horses 
        <small>Create New Horse</small>
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
            <h3 class="box-title"><?= __('Add Horse') ?></h3>
        </div><!-- /.box-header -->
        <?php echo $this->Form->create($horse, ['id'=>'validateform','role' => 'form', 'enctype' => 'multipart/form-data']); ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('name', ['class' => 'form-control','autocomplete'=>'off', 'placeholder' => ucfirst('name'), 'label' => ['text' => ucfirst('name'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('branch_id', ['class' => 'form-control','autocomplete'=>'off', 'options' => unserialize(BRANCH), 'label' => ['text' => ucfirst('BRANCH'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('code_number', ['class' => 'form-control', 'placeholder' => ucfirst('code Number'), 'label' => ['text' => ucfirst('code Number')]]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('image_file', ['class' => 'form-control','type'=>'file', 'placeholder' => ucfirst('image'), 'label' => ['text' => ucfirst('First image'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('image1_file', ['class' => 'form-control','type'=>'file', 'placeholder' => ucfirst('image'), 'label' => ['text' => ucfirst('Second image'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('image2_file', ['class' => 'form-control','type'=>'file', 'placeholder' => ucfirst('image'), 'label' => ['text' => ucfirst('Third image'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('fei_number', ['class' => 'form-control', 'placeholder' => ucfirst('FEI NUMBER'), 'label' => ['text' => ucfirst('fei Number')]]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('eef_number', ['class' => 'form-control', 'placeholder' => ucfirst('eef_number'), 'label' => ['text' => strtoupper(str_replace('_',' ','eef_number')),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('chipid', ['class' => 'form-control', 'placeholder' => ucfirst('Microchip Number'), 'label' => ['text' => strtoupper(str_replace('_',' ','Microchip Number')),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('birth_name', ['class' => 'form-control', 'placeholder' => ucfirst('birth_name'), 'label' => ['text' => strtoupper('birth Name'),'class'=>'req']]); ?>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('dob',  ['minYear' => '1990','maxYear' => '2050'],['class' => 'form-control', 'placeholder' => ucfirst('dob'), 'label' => ['text' => strtoupper('Year of Birth'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('height', ['class' => 'form-control', 'placeholder' => ucfirst('height'), 'label' => ['text' => strtoupper('height'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('sire', ['class' => 'form-control', 'placeholder' => ucfirst('sire'), 'label' => ['text' => strtoupper('sire'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('dam', ['class' => 'form-control', 'placeholder' => ucfirst('dam'), 'label' => ['text' => strtoupper('dam'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('gender', ['class' => 'form-control', 'options' => Configure::read('SEX_HORSE'),'placeholder' => strtoupper('Sex'), 'label' => ['text' => strtoupper('Sex'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('color', ['class' => 'form-control','options' =>Configure::read('COLOR_HORSE'),'empty'=>'--- Select Color ---' ,'placeholder' => strtoupper('color'), 'label' => ['text' => strtoupper('color'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('breed', ['class' => 'form-control', 'placeholder' => ucfirst('breed'), 'label' => ['text' => strtoupper('breed'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('country_id', ['class' => 'form-control','options'=>$countries, 'placeholder' => strtoupper('Country Birth'), 'label' => ['text' => strtoupper('Country Of Birth'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('passport_number', ['class' => 'form-control', 'placeholder' => strtoupper('passport number'), 'label' => ['text' => strtoupper('passport Number'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('status', ['class' => 'form-control','options' => [1 => "Active", 0 => "Inactive"], 'placeholder' => strtoupper('status'), 'label' => ['text' => strtoupper('status'),'class'=>'req']]); ?>
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
