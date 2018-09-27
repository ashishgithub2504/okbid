<?php
/**
 * @var \App\View\AppView $this
 */
use Cake\Core\Configure;
?>

<section class="content-header">
    <h1>
        Manage Property Commisions 
        <small>Create New Property Commision</small>
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
            <h3 class="box-title"><?= __('Add Property Commision') ?></h3>
        </div><!-- /.box-header -->
        <?php echo $this->Form->create($propertyCommision, ['id' => 'validateform', 'role' => 'form', 'enctype' => 'multipart/form-data']); ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('category', ['class' => 'form-control', 'options' => Configure::read('CATEGORY' . LAN), 'empty' => 'select', 'placeholder' => ucfirst('category'), 'label' => ['text' => ucfirst('category'), 'class' => 'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('subcategory_id', ['class' => 'form-control', 'options' => [], 'empty' => 'Please select', 'placeholder' => ucfirst('sub category'), 'label' => ['text' => ucfirst('sub Category'), 'class' => 'req']]); ?>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('commision', ['class' => 'form-control', 'placeholder' => ucfirst('commision'), 'label' => ['text' => ucfirst('commision in Percentage'), 'class' => 'req']]); ?>
                    </div>
                </div>
                
                
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('role_id', ['class' => 'form-control', 'options' => ['1'=>'buyer','2'=>'Seller','3'=>'Leader','4'=>'Agent','5'=>'Manager','6'=>'Building contractor'], 'label' => ['text' => ucfirst('User'), 'class' => 'req']]); ?>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('status', ['options'=>['1'=>'Active','0'=>'InActive'],'class' => 'form-control', 'placeholder' => ucfirst('status'), 'label' => ['text' => ucfirst('status'), 'class' => 'req']]); ?>
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