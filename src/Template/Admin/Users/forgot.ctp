<div class="login-box-body">
    <p class="login-box-msg" style="padding-bottom: 5px;">Forget Password ?</p>
    <p  style="padding-left: 15px;"><small>Enter your e-mail address below to reset your password.</small> </p>
    <?= $this->Flash->render() ?>
    <?php echo $this->Form->create('Users'); ?>
    <div class="form-group has-feedback">
        <?php
        echo $this->Form->input('email', ["class" => "form-control",
            'type' => 'email',
            'placeholder' => 'Email Id',
            'label' => false,
            'div' => false,
            'required'=>true,
        ]);
        ?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>

    <div class="row">
        <div class="col-xs-4 pull-left">
            <?php echo $this->Html->link('Back', ['controller' => 'Users', 'action' => 'login'], ['class' => 'btn btn-default btn-block btn-flat']); ?>
        </div><!-- /.col -->
        <div class="col-xs-4 pull-right">
            <?php echo $this->Form->button('Submit', ['type' => 'submit', 'class' => 'btn btn-primary btn-block btn-flat']); ?>
        </div><!-- /.col -->
    </div>
    <?php echo $this->form->end(); ?>
    <br>
</div><!-- /.login-box-body -->