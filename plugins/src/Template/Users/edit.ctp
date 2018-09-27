<?php
/**
  * @var \App\View\AppView $this
  */
?>

<section class="content-header">
    <h1>
        Manage Users 
        <small>Update User Details</small>
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
            <h3 class="box-title"><?= __('Edit User') ?></h3>
        </div><!-- /.box-header -->
        <?php echo $this->Form->create($user, ['id'=>'validateform','role' => 'form', 'enctype' => 'multipart/form-data']); ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('activation_code', ['class' => 'form-control', 'placeholder' => ucfirst('activation_code'), 'label' => ['text' => ucfirst('activation_code'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('auth_token', ['class' => 'form-control', 'placeholder' => ucfirst('auth_token'), 'label' => ['text' => ucfirst('auth_token'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('name', ['class' => 'form-control', 'placeholder' => ucfirst('name'), 'label' => ['text' => ucfirst('name'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('email', ['class' => 'form-control', 'placeholder' => ucfirst('email'), 'label' => ['text' => ucfirst('email'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('role_id', ['class' => 'form-control', 'options' => $roles, 'label' => ['text' => ucfirst('role_id')]]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('username', ['class' => 'form-control', 'placeholder' => ucfirst('username'), 'label' => ['text' => ucfirst('username'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('password', ['class' => 'form-control', 'placeholder' => ucfirst('password'), 'label' => ['text' => ucfirst('password'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('phone', ['class' => 'form-control', 'placeholder' => ucfirst('phone'), 'label' => ['text' => ucfirst('phone'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('mobile', ['class' => 'form-control', 'placeholder' => ucfirst('mobile'), 'label' => ['text' => ucfirst('mobile'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('nf_number', ['class' => 'form-control', 'placeholder' => ucfirst('nf_number'), 'label' => ['text' => ucfirst('nf_number'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('expiry_date', ['class' => 'form-control', 'placeholder' => ucfirst('expiry_date'), 'label' => ['text' => ucfirst('expiry_date'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('address', ['class' => 'form-control', 'placeholder' => ucfirst('address'), 'label' => ['text' => ucfirst('address'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('gender', ['class' => 'form-control', 'placeholder' => ucfirst('gender'), 'label' => ['text' => ucfirst('gender'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('nationality', ['class' => 'form-control', 'placeholder' => ucfirst('nationality'), 'label' => ['text' => ucfirst('nationality'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('profile_pic', ['class' => 'form-control', 'placeholder' => ucfirst('profile_pic'), 'label' => ['text' => ucfirst('profile_pic'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('online_status', ['class' => 'form-control', 'placeholder' => ucfirst('online_status'), 'label' => ['text' => ucfirst('online_status'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('verification_code', ['class' => 'form-control', 'placeholder' => ucfirst('verification_code'), 'label' => ['text' => ucfirst('verification_code'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('reset_key', ['class' => 'form-control', 'placeholder' => ucfirst('reset_key'), 'label' => ['text' => ucfirst('reset_key'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('eef_licence_number', ['class' => 'form-control', 'placeholder' => ucfirst('eef_licence_number'), 'label' => ['text' => ucfirst('eef_licence_number'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('login_by', ['class' => 'form-control', 'placeholder' => ucfirst('login_by'), 'label' => ['text' => ucfirst('login_by'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">        
                        <?php echo $this->Form->input('last_login', ['empty' => true, 'class' => 'form-control', 'placeholder' => ucfirst('last_login'), 'label' => ['text' => ucfirst('last_login'),'class'=>'req']]); ?>
                </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('is_verified', ['class' => 'form-control', 'placeholder' => ucfirst('is_verified'), 'label' => ['text' => ucfirst('is_verified'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('is_password', ['class' => 'form-control', 'placeholder' => ucfirst('is_password'), 'label' => ['text' => ucfirst('is_password'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('is_activation', ['class' => 'form-control', 'placeholder' => ucfirst('is_activation'), 'label' => ['text' => ucfirst('is_activation'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('fel_licence_number', ['class' => 'form-control', 'placeholder' => ucfirst('fel_licence_number'), 'label' => ['text' => ucfirst('fel_licence_number'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('qualification', ['class' => 'form-control', 'placeholder' => ucfirst('qualification'), 'label' => ['text' => ucfirst('qualification'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('noc_status', ['class' => 'form-control', 'placeholder' => ucfirst('noc_status'), 'label' => ['text' => ucfirst('noc_status'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('remarks', ['class' => 'form-control', 'placeholder' => ucfirst('remarks'), 'label' => ['text' => ucfirst('remarks'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('status', ['class' => 'form-control', 'placeholder' => ucfirst('status'), 'label' => ['text' => ucfirst('status'),'class'=>'req']]); ?>
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