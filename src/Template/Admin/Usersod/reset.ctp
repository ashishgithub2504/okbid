<div class="login-box-body">
    <p class="login-box-msg" style="padding-bottom: 5px;">Reset Your password ?</p>
    <?= $this->Flash->render() ?>
    <?php echo $this->Form->create('User', ['type' => 'file']); ?>
    <div class="form-group has-feedback">
        <?php
        echo $this->Form->input('password', ["class" => "form-control",
            'type' => 'password',
            'placeholder' => 'Password',
            'label' => false,
            'div' => false
        ]);
        ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <?php
        echo $this->Form->input('confirm_password', ["class" => "form-control",
            'type' => 'password',
            'placeholder' => 'Confirm Password',
            'label' => false,
            'div' => false
        ]);
        ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>

    <div class="row">
        
        <div class="col-xs-4 pull-right">
            <?php echo $this->Form->button('Submit', ['type' => 'submit', 'class' => 'btn btn-primary btn-block btn-flat']); ?>
        </div><!-- /.col -->
    </div>
    <?php echo $this->form->end(); ?>
    <br>
</div><!-- /.login-box-body -->