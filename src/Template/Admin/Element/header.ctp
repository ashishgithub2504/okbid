<header class="main-header">
    <!-- Logo -->
    <?php echo $this->Html->link($SettingConfig['sitename'], ["controller" => "dashboard", "action" => "index"], ["class" => "logo", "escape" => false, 'style' => 'background-color:#47B3FE;']);
    ?>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

<?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('1', '2','3','4','5','6'))) { ?>`
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('1'))) { ?>`
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success"><?= count($msgnotification); ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have <?= count($msgnotification); ?> messages</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <?php if(!empty($msgnotification)){
                                            foreach($msgnotification as $key=>$val){ ?>
                                                <li><!-- start message -->
                                                    <a href="<?= _BASE_.'admin/conversations/message/'.$val['id']; ?>">
                                                        <div class="pull-left">
                                                            <?php echo $this->Html->image('/uploads/users/'.$val['user']['profile_pic'],['class'=>'img-circle']); ?>
                                                        </div>
                                                        <h4>
                                                            <?= $val['title']; ?>
<!--                                                            <small><i class="fa fa-clock-o"></i> 5 mins</small>-->
                                                        </h4>
                                                        <p><?= $val['message']; ?></p>
                                                    </a>
                                                </li>
                                    <?php }
                                    } ?>
                                    
                                </ul>
                            </li>
                            <li class="footer"><?php echo $this->Html->link('See All Messages',['controller'=>'conversations','action'=>'index']) ?></li>
                        </ul>
                    </li>

                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning"><?= count($messages); ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have <?= count($messages); ?> notifications</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <?php  if(!empty($messages)){
                                                foreach ($messages as $message){ ?>
                                            <li>
                                                <?php echo $this->Html->link('<i class="fa fa-home text-aqua"></i> ' .$message['message'],['controller'=>$message['controller'] , 'action' => $message['action']],['escape'=>false]); ?>
                                            </li>          
                                    <?php      }
                                    } ?>
                                            
<!--                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                                            page and may cause design problems
                                        </a>
                                    </li>-->
<!--                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-red"></i> 5 new members joined
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-user text-red"></i> You changed your username
                                        </a>
                                    </li>-->
                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                    
                   <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <?php
                        if (!empty($userData['profile_pic']))
                            echo $this->Html->image('/uploads/users/' . $userData['profile_pic'], ["class" => "user-image", "alt" => ""]);
                        else
                            echo $this->Html->image("avatar.png", ["class" => "user-image", "alt" => "User Image"]);
                        ?>
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs"><?php echo $userData['name']; ?></span>
                    </a>

                    <ul class="dropdown-menu">


                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <?php
                            if (!empty($userData['profile_pic']))
                                echo $this->Html->image('/uploads/users/' . $userData['profile_pic'], ["class" => "img-circle", "alt" => "User Image"]);
                            else
                                echo $this->Html->image("avatar.png", ["class" => "img-circle", "alt" => "User Image"]);
                            ?>
                            <p>
<?php echo $userData['name']; ?>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row">
                                <div class="col-xs-6 text-center">
<?php echo $this->Html->link("Change Password", ["controller" => "users", "action" => "change_password"]); ?>
                                </div>
                            </div>
                            <!-- /.row -->
                        </li>
                        <li class="user-footer">
                            <div class="col-xs-4 text-center">
                                <?php echo $this->Html->link("Profile", ["controller" => "users", "action" => "profile_view"], ["class" => "btn btn-default btn-flat"]); ?>
                            </div>
                            <div class="col-xs-4 text-center">
                                <?php echo $this->Html->link("Edit", ["controller" => "users", "action" => "profile"], ["class" => "btn btn-default btn-flat"]); ?>
                            </div>
                            <div class="col-xs-4 text-center">
<?php echo $this->Html->link("Sign out", ["controller" => "users", "action" => "logout"], ["class" => "btn btn-default btn-flat"]); ?>
                            </div>
                        </li>
                    </ul>
                </li>
                    <!-- Tasks: style can be found in dropdown.less -->
                    <!--          <li class="dropdown tasks-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                  <i class="fa fa-flag-o"></i>
                                  <span class="label label-danger">9</span>
                                </a>
                                <ul class="dropdown-menu">
                                  <li class="header">You have 9 tasks</li>
                                  <li>
                                     inner menu: contains the actual data 
                                    <ul class="menu">
                                      <li> Task item 
                                        <a href="#">
                                          <h3>
                                            Design some buttons
                                            <small class="pull-right">20%</small>
                                          </h3>
                                          <div class="progress xs">
                                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                              <span class="sr-only">20% Complete</span>
                                            </div>
                                          </div>
                                        </a>
                                      </li>
                                       end task item 
                                      <li> Task item 
                                        <a href="#">
                                          <h3>
                                            Create a nice theme
                                            <small class="pull-right">40%</small>
                                          </h3>
                                          <div class="progress xs">
                                            <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                              <span class="sr-only">40% Complete</span>
                                            </div>
                                          </div>
                                        </a>
                                      </li>
                                       end task item 
                                      <li> Task item 
                                        <a href="#">
                                          <h3>
                                            Some task I need to do
                                            <small class="pull-right">60%</small>
                                          </h3>
                                          <div class="progress xs">
                                            <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                              <span class="sr-only">60% Complete</span>
                                            </div>
                                          </div>
                                        </a>
                                      </li>
                                       end task item 
                                      <li> Task item 
                                        <a href="#">
                                          <h3>
                                            Make beautiful transitions
                                            <small class="pull-right">80%</small>
                                          </h3>
                                          <div class="progress xs">
                                            <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                              <span class="sr-only">80% Complete</span>
                                            </div>
                                          </div>
                                        </a>
                                      </li>
                                       end task item 
                                    </ul>
                                  </li>
                                  <li class="footer">
                                    <a href="#">View all tasks</a>
                                  </li>
                                </ul>
                              </li>-->

                </ul>
            </div>
<?php } ?>

    </nav>
</header>

<style type="text/css">
    .skin-blue .main-header .logo {
        background-color: #cc920e;
        color: #fff;
        border-bottom: 0 solid transparent;
    }    
    .icon-bell::before {
        content: "\e027";
    }
    .dropdown-menu-list li span{
        padding:5px;
        margin-bottom:5px;
    }
</style>