<section class="content-header">
    <h1>
        Manage Hourse <small><?php echo empty($user->id) ? "Add New Hourse" : "Update User Details"; ?></small>
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
            <h3 class="box-title"><?= __(empty($user['id']) ? 'Add Hourse' : "Edit Hourse") ?></h3>
        </div><!-- /.box-header -->
        <?php echo $this->Form->create($user, ['id' => 'validateform', 'role' => 'form', 'enctype' => 'multipart/form-data']); ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('name', ['class' => 'form-control', 'placeholder' => 'Hourse Name', 'label' => ['text' => "Hourse Name", 'class' => 'req']]); ?>
                    </div><!-- /.form-group -->
                </div>
<!--                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('activation_code', ['class' => 'form-control', 'placeholder' => 'Activation code', 'label' => ['text' => "Activation code", 'class' => 'req']]); ?>
                    </div> /.form-group 
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('phone', ['class' => 'form-control', 'placeholder' => 'Contact number', 'onkeypress' => 'validate(event)', 'label' => ['text' => "Contact number", 'class' => 'req']]); ?>
                    </div> /.form-group 
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('mobile', ['class' => 'form-control', 'placeholder' => 'Mobile number', 'label' => ['text' => "Mobile number", 'class' => 'req']]); ?>
                    </div> /.form-group 
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('password', ['type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'value' => '', 'required' => false, 'label' => ['text' => "Password"]]); ?>
                    </div> /.form-group 
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('confirm_password', ['type' => 'password', 'class' => 'form-control input-large', 'placeholder' => 'Confirm Password', 'value' => '', 'label' => ['text' => "Confirm Password"], 'required' => false]); ?>
                    </div> /.form-group 
                </div>-->
<!--                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('gender', ['type' => 'select', 'class' => 'form-control', 'options' => [1 => "Male", 2 => "Female"], 'label' => ['text' => "Gender"]]); ?>
                    </div> /.form-group 
                </div>-->
                <!-- /.col -->
<!--                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('email', ['class' => 'form-control', 'placeholder' => 'Email', 'label' => ['text' => "Email", 'class' => 'req']]); ?>
                    </div> /.form-group 
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('username', ['class' => 'form-control', 'placeholder' => 'Manager Name', 'label' => ['text' => "Manager Name", 'class' => 'req']]); ?>
                    </div> /.form-group 
                </div>-->

                <!--                <div class="col-md-6">
                                    <div class="form-group">
                <?php //echo $this->Form->input('accno', ['type' => 'text', 'class' => 'form-control input-large', 'placeholder' => 'App Account Number', 'label' => ['text' => "App Account Number"], 'required' => false]); ?>
                                       </div> /.form-group 
                                </div>-->

<!--                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('expiry_date', ['type' => 'text', 'class' => 'form-control input-large', 'id' => 'datepicker', 'placeholder' => 'Account Expiry Date', 'label' => ['text' => "Account Expiry Date"], 'required' => false]); ?>
                    </div> /.form-group 
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('address', ['type' => 'text', 'class' => 'form-control input-large', 'placeholder' => 'Nursery Address', 'label' => ['text' => "Nursery Address"], 'required' => false]); ?>
                    </div> /.form-group 
                </div>-->
                <div class="col-md-6">
                    <div class="form-group">
                        <?php
                        echo $this->Form->input('profile_pic_file', ['type' => 'file', 'label' => ['text' => "Profile Pic"]]);
                        if (!empty($user['profile_pic'])) {
                            ?>
                            <div style="float:right;">
                            <?php echo $this->Html->image('/uploads/users/' . $user['profile_pic'], array('width' => '100', 'alt' => 'Profile Pic')); ?>
                            </div>
<?php } ?>
                    </div>
                </div>
<!--                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->input('status', ['type' => 'select', 'class' => 'form-control', 'options' => [1 => "Active", 0 => "Inactive"], 'label' => ['text' => "Status"]]); ?>
                    </div> /.form-group 
                </div> /.col -->

            </div><!-- /.row -->
        </div><!-- /.box-body -->

<!--        <div class="box-header with-border">
            <h3 class="box-title"><?= __(empty($user['id']) ? 'Add Classes' : "Edit Classes") ?></h3>
        </div>
        
        <div class="row classesadd">
            <?php if(!empty($listgrups)){ 
                    foreach ($listgrups as $k=>$list){
                ?>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo $this->Form->input('groups['.$list['id'].'][]', ['type' => 'text', 'class' => 'form-control input-large','value' => $list['name'] ,'placeholder' => 'Classes', 'label' => ['text' => "Nursery Address"], 'required' => false]); ?>
                </div>
            </div>
            <?php } } ?>
            
            <div class="col-md-6">
                <div class="form-group">
                    <input type="button" id="addclass" value="AddClass" class = "btn btn-primary" />
                </div>
            </div>
            
        </div>-->

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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    $(function () {
        $("#datepicker").datepicker({
            dateFormat: 'yyyy-mm-dd'
        });

        function validateNumber(event) {
            var key = window.event ? event.keyCode : event.which;
            if (event.keyCode === 8 || event.keyCode === 46) {
                return true;
            } else if (key < 48 || key > 57) {
                return false;
            } else {
                return true;
            }
        }

        $("#phone, #mobile").keypress(validateNumber);

        (function (event) {
            var theEvent = evt || window.event;

            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
            var regex = /[0-9]|\./;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault)
                    theEvent.preventDefault();
            }
        });

        $("#addclass").click(function () {
            $(".classesadd").append('<div class="groups"><div class="col-md-6"><div class="form-group"><input name="class[]" class="form-control" type="text"></div></div><div class="col-md-6"><div class="form-group"><input type="button" value="Save" class = "saveclass btn btn-primary" /></div></div></div>');
        
        $(".saveclass").click(function () {
            var classname =  $(this).parent().parent().parent().find('input').val();
            
            $.ajax({
                method: "POST",
                url: "http://localhost/cake3basic/admin/users/saveclasses",
                data: {user_id: "<?php echo $user['id']; ?>", name: classname}
            })
            .done(function (msg) {
                alert("Data Saved: " + msg);
            });
        });
        
        });
    });
</script>