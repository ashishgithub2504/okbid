<section class="content-header">
    <h1>
        Manage Users <small><?php echo empty($user->id) ? "Create new User" : "Update User Details"; ?></small>
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
            <h3 class="box-title"><?= __(empty($user->id) ? 'Add User' : "Edit User") ?></h3>
        </div><!-- /.box-header -->
        <?php echo $this->Form->create($user, ['id'=>'validateform','role' => 'form', 'enctype' => 'multipart/form-data']); ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('name', ['class' => 'form-control', 'placeholder' => 'Name', 'label' => ['text' => "Name",'class'=>'req']]); ?>
                    </div><!-- /.form-group -->
                    <div class="form-group">
                        <?php echo $this->Form->input('phone', ['class' => 'form-control', 'placeholder' => 'Contact number', 'label' => ['text' => "Contact number",'class'=>'req']]); ?>
                    </div><!-- /.form-group -->
                    <div class="form-group">
                        <?php echo $this->Form->input('password', ['type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'value' => '', 'required' => false, 'label' => ['text' => "Password"]]); ?>
                    </div><!-- /.form-group -->
                    <div class="form-group">
                        <?php echo $this->Form->input('gender', ['type' => 'select', 'class' => 'form-control', 'options' => [1 => "Male", 2 => "Female"], 'label' => ['text' => "Gender"]]); ?>
                    </div><!-- /.form-group -->
                    <div class="form-group">
                       <?php echo $this->Form->input('profile_pic_file', ['type' => 'file','label' => ['text' => "Profile Pic"]]);
                        if(!empty($this->request->data['profile_pic'])){ ?>
                        <div style="float:right;">
                            <?php echo $this->Html->image('/uploads/users/'.$this->request->data['profile_pic'], array('width'=>'100','alt' => 'Profile Pic')); ?>
                        </div>
                        <?php } ?>
                    </div>
                </div><!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('email', ['class' => 'form-control', 'placeholder' => 'Email', 'label' => ['text' => "Email",'class'=>'req']]); ?>
                    </div><!-- /.form-group -->
                    <div class="form-group">
                        <?php echo $this->Form->input('username', ['class' => 'form-control', 'placeholder' => 'Username', 'label' => ['text' => "Username",'class'=>'req']]); ?>
                    </div><!-- /.form-group -->
                    <div class="form-group">
                        <?php echo $this->Form->input('confirm_password', ['type' => 'password', 'class' => 'form-control input-large', 'placeholder' => 'Confirm Password', 'value' => '', 'label' => ['text' => "Confirm Password"], 'required' => false]); ?>
                    </div><!-- /.form-group -->
                    <div class="form-group">
                        <?php echo $this->Form->input('status', ['type' => 'select', 'class' => 'form-control', 'options' => [1 => "Active", 0 => "Inactive"], 'label' => ['text' => "Status"]]); ?>
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
<style>
    .file{
        float:left;
    }
</style>