<?php
/**
  * @var \App\View\AppView $this
  */
?>

<section class="content-header">
    <h1>
        Manage Horse Vaccinations 
        <small>Create New Horse Vaccination</small>
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
            <h3 class="box-title"><?= __('Add Horse Vaccination') ?></h3>
        </div><!-- /.box-header -->
        <?php echo $this->Form->create($horseVaccination, ['id'=>'validateform','role' => 'form', 'enctype' => 'multipart/form-data']); ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo $this->Form->input('horse_id', ['class' => 'form-control', 'options' => $horses, 'label' => ['text' => ucfirst('horse Name')]]); ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">         
                        <?php echo $this->Form->input('vaccination_date', ['class' => 'form-control', 'placeholder' => ucfirst('vaccination_date'), 'label' => ['text' => ucfirst('vaccination Currnt Date'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('status', ['class' => 'form-control','options' => [1 => "Active", 0 => "Inactive"], 'placeholder' => ucfirst('status'), 'label' => ['text' => ucfirst('status'),'class'=>'req']]); ?>
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