<?php
/**
  * @var \App\View\AppView $this
  */
?>

<section class="content-header">
    <h1>
        Manage Gallery 
        <small><?php echo empty($image->id) ? "Create New Gallery Image" : "Update Image Details"; ?></small>
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
            <h3 class="box-title"><?= __(empty($image->id) ? 'Add Image' : "Edit Image") ?></h3>
        </div><!-- /.box-header -->
        <?php echo $this->Form->create($image, ['id'=>'validateform','role' => 'form', 'enctype' => 'multipart/form-data']); ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('title', ['class' => 'form-control', 'placeholder' => ucfirst('title'), 'label' => ['text' => ucfirst('title'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('event_name', ['class' => 'form-control', 'placeholder' => ucfirst('event name'), 'label' => ['text' => ucfirst('event name'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('event_owner', ['class' => 'form-control', 'placeholder' => ucfirst('event owner'), 'label' => ['text' => ucfirst('event owner'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('status', ['class' => 'form-control','options' => [1 => "Active", 0 => "Inactive"], 'placeholder' => ucfirst('status'), 'label' => ['text' => ucfirst('status'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                       <?php 
                        echo $this->Form->input('image_file', ['type' => 'file','label' => ['text' => "Upload Image"],'required' => (!empty($image['image']))?false:true]);

                        if(!empty($image['image'])){ ?>
                        <div style="float:right;">
                            <?php echo $this->Html->image('/uploads/images/'.$image['image'], array('width'=>'100','alt' => 'Gallery Image')); ?>
                        </div>
                        <?php } ?>
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
<style>
    .file{
        float:left;
    }
</style>