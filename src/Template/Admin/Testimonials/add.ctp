<section class="content-header">
    <h1>
        Manage Testimonials <small><?php echo empty($testimonial->id) ? "Create New Testimonial" : "Update Testimonial Details"; ?></small>
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
            <h3 class="box-title"><?= __(empty($testimonial->id) ? 'Add Testimonial' : "Edit Testimonial") ?></h3>
        </div><!-- /.box-header -->
        <?php echo $this->Form->create($testimonial, ['id'=>'validateform','role' => 'form']); ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <?php echo $this->Form->input('user_id', ['type' => 'select', 'class' => 'form-control', 'options' => $users, 'empty' => true, 'label' => ['text' => "Select User"]]); ?>
                    </div><!-- /.form-group -->
                    <div class="form-group">
                        <?php echo $this->Form->input('title', ['class' => 'form-control', 'placeholder' => 'Title', 'label' => ['text' => "Title",'class'=>'req']]); ?>
                    </div><!-- /.form-group -->
                </div><!-- /.col -->
                <div class="col-md-1">
                    <div class="form-group"  style="margin-top: 25px;">
                        -- OR --
                    </div><!-- /.form-group -->
                </div><!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('user_name', ['class' => 'form-control', 'placeholder' => 'User Name', 'label' => ['text' => "User Name",'class'=>'req']]); ?>
                    </div><!-- /.form-group -->
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo $this->Form->input('content', ['type' => 'textarea', 'class' => 'form-control ckeditor', 'placeholder' => 'Content', 'label' => ['text' => "Content"]]); ?>
                    </div><!-- /.form-group -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.box-body -->
        <div class="box-footer">
            <?php echo $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']); ?>
            <?php echo $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn default']); ?>
        </div>
        <?= $this->Form->end() ?>
    </div><!-- /.box -->
</section>