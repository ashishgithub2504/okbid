<?php
/**
  * @var \App\View\AppView $this
  */
use Cake\Core\Configure;
?>

<section class="content-header">
    <h1>
        Manage Users 
        <small>Create New User</small>
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
            <h3 class="box-title"><?= __('Add User') ?></h3>
        </div><!-- /.box-header -->
        <?php echo $this->Form->create($user, ['id'=>'validateform','role' => 'form', 'enctype' => 'multipart/form-data']); ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('name', ['class' => 'form-control', 'placeholder' => ucfirst('full Name'), 'label' => ['text' => ucfirst('full Name'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('email', ['class' => 'form-control', 'placeholder' => ucfirst('email'), 'label' => ['text' => ucfirst('email'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('role_id', ['class' => 'form-control', 'options' => $roles, 'label' => ['text' => ucfirst('User type')]]); ?>
                    </div>
                </div>
                <div class="col-md-6" id="managershow">
                    <div class="form-group">
                        <?php echo $this->Form->input('manager_id', ['class' => 'form-control','empty'=>' Select Manager' ,'options' => $manager, 'label' => ['text' => ucfirst('Manager')]]); ?>
                    </div>
                </div>
                <div class="col-md-6 companyshow" id="companyshow">
                    <div class="form-group">
                        <?php echo $this->Form->input('company', ['class' => 'form-control', 'label' => ['text' => ucfirst('Company Name')]]); ?>
                    </div>
                </div>
                <div class="col-md-6 companyshow">
                    <div class="form-group">
                        <?php echo $this->Form->input('company_no', ['class' => 'form-control', 'label' => ['text' => ucfirst('Company Number')]]); ?>
                    </div>
                </div>
                <div class="col-md-6 companyshow">
                    <div class="form-group">
                        <?php echo $this->Form->input('company_id', ['class' => 'form-control','type'=>'text' ,'label' => ['text' => ucfirst('Company ID')]]); ?>
                    </div>
                </div>
                
<!--                <div class="col-md-6">
                    <div class="form-group">         
                        <?php //echo $this->Form->input('username', ['class' => 'form-control','placeholder' => ucfirst('username'),'autocomplete'=>'off', 'label' => ['text' => ucfirst('username'),'class'=>'req']]); ?>
                    </div>
                </div>-->
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('password', ['class' => 'form-control', 'placeholder' => ucfirst('password'),'autocomplete'=>'off', 'label' => ['text' => ucfirst('password'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('cpassword', ['class' => 'form-control', 'placeholder' => ucfirst('Confirm password'),'autocomplete'=>'off', 'label' => ['text' => ucfirst('Confirm password'),'class'=>'req']]); ?>
                    </div>
                </div>
                
                <div class="col-md-2">
                    <div class="form-group">         
                        <?php echo $this->Form->input('prefix', ['class' => 'form-control', 'options' => $prefix, 'label' => ['text' => ucfirst('prefix')] ]); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">         
                        <?php echo $this->Form->input('phone', ['class' => 'form-control', 'placeholder' => ucfirst('phone'), 'label' => ['text' => ucfirst('phone'),'class'=>'req']]); ?>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('gender', ['class' => 'form-control', 'options' => ['0'=>'Female', '1'=>'Male'], 'label' => ['text' => ucfirst('Gender')] ]); ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('address', ['class' => 'form-control', 'placeholder' => ucfirst('address'), 'label' => ['text' => ucfirst('address'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('city', ['class' => 'form-control', 'placeholder' => ucfirst('city'), 'label' => ['text' => ucfirst('city (where he works)'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('notes', ['class' => 'form-control', 'placeholder' => ucfirst('write notes'), 'label' => ['text' => ucfirst('write notes'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('profile_pic_file', ['class' => 'form-control', 'type' => 'file', 'label' => ['text' => ucfirst('Profile Pic'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('status', ['class' => 'form-control', 'options' => ['1'=>'Active','0'=>'InActive'], 'label' => ['text' => ucfirst('status'),'class'=>'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">         
                        <?php echo $this->Form->input('Legal', ['class' => 'form-control12','type'=>'checkbox','label' => ['text' => ucfirst('Legal Department'), 'class' => 'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6 legal">
                    <div class="form-group">         
                        <?php echo $this->Form->input('claim', ['class' => 'form-control','empty'=>'Select','options'=>['1'=>'The plaintiff customer','2'=>'A customer is sued'] ,'label' => ['text' => ucfirst('Claim Status'), 'class' => 'req']]); ?>
                    </div>
                </div>
                <div class="col-md-6 legal">
                    <div class="form-group">         
                        <?php echo $this->Form->input('remark', ['class' => 'form-control', 'label' => ['text' => ucfirst('Remark'), 'class' => 'req']]); ?>
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
<script type="text/javascript">
$(document).ready(function(){
   $('#managershow , .companyshow, .legal').hide();
   
   $("#legal").click(function(){
       if($("#legal").is(':checked'))
       $(".legal").hide();
       else
       $(".legal").show();
   });
   
   $("#role-id").change(function(){
      if($(this).val() == '3'){
          $('#managershow').show();
      }else{
          $('#managershow').hide();
      }
      
      if( $(this).val() == '6'){
          $('.companyshow').show();
      }else{
          $('.companyshow').hide();
      }
      
   });
});  
</script>
      