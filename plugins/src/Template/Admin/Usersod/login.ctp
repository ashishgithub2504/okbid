<div class="login-box-body" style="background-color: #393837;">
    <p class="login-box-msg">Login to your account</p>
    <?= $this->Flash->render() ?>
    <?php echo $this->Form->create('User', ['type' => 'file']); ?>
    <div class="form-group has-feedback">
        <?php
        echo $this->Form->input('username', ["class" => "form-control",
            'type' => 'text',
            'placeholder' => 'Username',
            'autocomplete' => 'off',
            'label' => false,
            'div' => false
        ]);
        ?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <?php
        echo $this->Form->input('password', ["class" => "form-control",
            'type' => 'password',
            'placeholder' => 'Password',
            'autocomplete' => 'off',
            'label' => false,
            'div' => false
        ]);
        ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="row">
        <div class="col-xs-8">
            <div class="checkbox icheck">
                <?php
                echo $this->Form->input('remember_me', [
                    'type' => 'checkbox',
                    "div" => false,
                    "label" => ["text" => " Remember Me", "style" => "padding-left:20px;"],
                ]);
                ?>
            </div>
        </div><!-- /.col -->
        <div class="col-xs-4">
            <?php echo $this->Form->button('Sign In', ['type' => 'submit', 'class' => 'btn btn-primary btn-block btn-flat']); ?>
        </div><!-- /.col -->
    </div>
    <?php
    echo $this->form->end();
    echo $this->Html->link("I forgot my password", ['controller' => 'Users', 'action' => 'forgot']);
    ?>
    <br>
</div><!-- /.login-box-body -->
