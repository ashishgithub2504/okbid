<?php
/**
  * @var \App\View\AppView $this
  */
?>

<section class="content-header">
    <h1>
        Manage Campaigns <small><?php echo empty($campaign->id) ? "Add new campaign" : "Update campaign details"; ?></small>
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
            <h3 class="box-title"><?= __(empty($campaign->id) ? 'Add Campaign' : "Edit Campaign") ?></h3>
        </div><!-- /.box-header -->
        <?php echo $this->Form->create($campaign, ['id'=>'validateform','role' => 'form', 'enctype' => 'multipart/form-data']); ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('name', ['class' => 'form-control', 'placeholder' => ucfirst('name'), 'label' => ['text' => ucfirst('name')],'required' => true]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('subject', ['class' => 'form-control', 'placeholder' => ucfirst('subject'), 'label' => ['text' => 'Subject for mail'],'required' => true]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('status', ['options' => [1 => "Active", 0 => "Inactive"],'class' => 'form-control', 'placeholder' => ucfirst('status'), 'label' => ['text' => ucfirst('status')]]); ?>
                    </div>
                </div>
            </div><!-- /.row -->
            <div class="row">
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