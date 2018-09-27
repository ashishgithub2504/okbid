<section class="content-header">
    <h1>
        Change Password
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
            <h3 class="box-title">Change Password</h3>
        </div><!-- /.box-header -->
        <?php
        echo $this->Form->create('Users', ['role' => 'form']);
        ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('old_password', ['type' => 'password', 'class' => 'form-control', 'placeholder' => 'Current Password', 'label' => ['text' => "Current Password"]]); ?>
                    </div><!-- /.form-group -->




                </div><!-- /.col -->

                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('new_password', ['type' => 'password', 'class' => 'form-control', 'placeholder' => 'New Password', 'label' => ['text' => "New Password"]]); ?>
                    </div><!-- /.form-group -->
                </div><!-- /.col -->

                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('confirm_password', ['type' => 'password', 'class' => 'form-control', 'placeholder' => 'Confirm password', 'label' => ['text' => "Confirm Password"]]); ?>
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