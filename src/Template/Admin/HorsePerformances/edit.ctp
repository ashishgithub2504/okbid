<?php
/**
 * @var \App\View\AppView $this
 */
?>

<section class="content-header">
    <h1>
        Manage Horse Performances 
        <small>Update Horse Performance Details</small>
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
            <h3 class="box-title"><?= __('Edit Horse Performance') ?></h3>
        </div><!-- /.box-header -->
        <?php echo $this->Form->create($horsePerformance, ['id' => 'validateform', 'role' => 'form', 'enctype' => 'multipart/form-data']); ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('horse_id', ['class' => 'form-control', 'options' => $horses, 'label' => ['text' => ucfirst('horse_id')]]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('rider_id', ['class' => 'form-control', 'options' => $riders, 'label' => ['text' => ucfirst('Rider Name')]]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('event_name', ['class' => 'form-control', 'placeholder' => ucfirst('event Name'), 'label' => ['text' => ucfirst('event Name'), 'class' => 'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('average_speed', ['class' => 'form-control', 'placeholder' => ucfirst('average Speed'), 'label' => ['text' => ucfirst('average Speed'), 'class' => 'req']]); ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">         
                        <?php echo $this->Form->input('running_date', ['class' => 'form-control', 'placeholder' => ucfirst('running_date'), 'label' => ['text' => ucfirst('running_date'), 'class' => 'req']]); ?>
                    </div>
                </div>                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('sponsor', ['class' => 'form-control', 'placeholder' => ucfirst('sponsor'), 'label' => ['text' => ucfirst('sponsor'), 'class' => 'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('place', ['class' => 'form-control', 'placeholder' => ucfirst('Position'), 'label' => ['text' => ucfirst('Position'), 'class' => 'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('where', ['class' => 'form-control', 'placeholder' => ucfirst('where'), 'label' => ['text' => ucfirst('where'), 'class' => 'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('reason', ['class' => 'form-control', 'placeholder' => ucfirst('reason'), 'label' => ['text' => ucfirst('reason'), 'class' => 'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('remark', ['class' => 'form-control', 'placeholder' => ucfirst('remark'), 'label' => ['text' => ucfirst('remark'), 'class' => 'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('status', ['class' => 'form-control', 'options' => ['0' => 'InActive', '1' => 'Active'], 'placeholder' => ucfirst('status'), 'label' => ['text' => ucfirst('status'), 'class' => 'req']]); ?>
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