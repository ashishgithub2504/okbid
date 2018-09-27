<?php
/**
  * @var \App\View\AppView $this
  */
?>

<section class="content-header">
    <h1>
        Manage News 
        <small><?php echo empty($news->id) ? "Create News" : "Update News Details"; ?></small>
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
            <h3 class="box-title"><?= __(empty($news->id) ? 'Add News' : "Edit News") ?></h3>
        </div><!-- /.box-header -->
        <?php echo $this->Form->create($news, ['id'=>'validateform','role' => 'form', 'enctype' => 'multipart/form-data']); ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('category_id', ['class' => 'form-control', 'options' => $categories, 'label' => ['text' => 'Select Category']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('title', ['class' => 'form-control', 'placeholder' => ucfirst('title'), 'label' => ['text' => ucfirst('title'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('short_desc', ['class' => 'form-control', 'placeholder' => ucfirst('short_desc'), 'label' => ['text' => 'Short Description','class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('status', ['options' => [1 => "Active", 0 => "Inactive"],'class' => 'form-control', 'placeholder' => ucfirst('status'), 'label' => ['text' => ucfirst('status'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                       <?php 
                        echo $this->Form->input('image_file', ['type' => 'file','label' => ['text' => "Upload Image"]]);

                        if(!empty($news['image'])){ ?>
                        <div style="float:right;">
                            <?php echo $this->Html->image('/uploads/news/'.$news['image'], array('width'=>'100','alt' => 'Image')); ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div><!-- /.row -->
            <div class="row" style="margin-top: 15px;">
                <div class="col-md-12">
                    <div class="form-group">         
                        <?php echo $this->Form->input('description', ['class' => 'form-control ckeditor', 'placeholder' => ucfirst('description'), 'label' => ['text' => ucfirst('description')],'required' => true]); ?>
                    </div>
                </div>
            </div>
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