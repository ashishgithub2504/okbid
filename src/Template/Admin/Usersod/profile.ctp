<section class="content-header">
    <h1>
        Manage Admin <small>Update Profile</small>
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
            <h3 class="box-title">Update Admin Profile</h3>
        </div><!-- /.box-header -->
        <?php echo $this->Form->create('Users',array('enctype'=>'multipart/form-data')); ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('name', array("label" => false, "div" => false, 'placeholder' => 'Name', 'class' => 'form-control', 'required' => true)); ?>
                    </div><!-- /.form-group -->
                    <div class="form-group">
                        <?php echo $this->Form->input('username', array("label" => false, "div" => false, 'placeholder' => 'Username', 'class' => 'form-control', 'required' => true)); ?>
                    </div><!-- /.form-group -->
                    <div class="form-group">
                       <?php 
                        echo $this->Form->input('profile_pic_file', ['type' => 'file','label' => ['text' => "Profile Pic"]]);

                       if(!empty($this->request->data['profile_pic'])){ ?>
                        <div style="float:right;">
                       <?php echo $this->Html->image('/uploads/users/'.$this->request->data['profile_pic'], array('width'=>'100','alt' => 'Profile Pic')); ?>
                        </div>
                        <?php } ?>
                    </div>
                </div><!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('email', array("type" => 'email', "label" => false, "div" => false, 'placeholder' => 'Email', 'class' => 'form-control', 'required' => true)); ?>
                    </div><!-- /.form-group -->
                    <div class="form-group">
                        <?php echo $this->Form->input('phone', array("label" => false, "div" => false, 'placeholder' => 'Phone', 'class' => 'form-control')); ?>
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
  