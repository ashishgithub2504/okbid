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
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('1', '5'))) { ?>`
                    <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                        <a href="javascript:;" class="dropdown-toggle label label-sm label-icon" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="true">
                            <i class="fa fa-bell" style="font-size:18px"></i>
                            <span class="badge badge-default" style="position:absolute; top:6px; left: 30px;"> <?= count($pendingproty); ?> </span>
                        </a>
                        <ul class="dropdown-menu" style="width:300px;">
                            <li class="external">
                                <h3>
                                    <span class="bold" style="margin-left:20px;"><?= count($pendingproty); ?>  pending</span> Properties</h3>
                            </li>
                            <li>
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;">
                                    <ul class="dropdown-menu-list scroller" style="height: 250px; overflow: hidden; width: auto;" data-handle-color="#637283" data-initialized="1">
                                        <?php
                                        if (!empty($pendingproty)) {
                                            foreach ($pendingproty as $key => $val) {
                                                ?>
                                                <li>
                                                    <a href="<?= _BASE_; ?>admin/properties/view/<?= $key; ?>">

                                                        <span class="details">
                                                            <span class="label label-sm label-icon label-success">
            <?= $val; ?>
                                                            </span> </span>
                                                    </a>
                                                </li>
        <?php }
    } ?>
                                    </ul><div class="slimScrollBar" style="background: rgb(99, 114, 131) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 121.359px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

<?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('3'))) { ?>`
                    <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                        <a href="javascript:;" class="dropdown-toggle label label-sm label-icon" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="true">
                            <i class="fa fa-bell" style="font-size:18px"></i>
                            <span class="badge badge-default" style="position:absolute; top:7px;"> <?= count($assignproty); ?> </span>
                        </a>
                        <ul class="dropdown-menu" style="width:300px;">
                            <li class="external">
                                <h3>
                                    <span class="bold" style="margin-left:20px;"><?= count($assignproty); ?>  Assign</span> Properties</h3>
                            </li>
                            <li>
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;">
                                    <ul class="dropdown-menu-list scroller" style="height: 250px; overflow: hidden; width: auto;" data-handle-color="#637283" data-initialized="1">
                                        <?php
                                        if (!empty($assignproty)) {
                                            foreach ($assignproty as $key => $val) {
                                                ?>
                                                <li>
                                                    <a href="<?= _BASE_; ?>admin/properties/view/<?= $key; ?>">

                                                        <span class="details">
                                                            <span class="label label-sm label-icon label-success">

                                                <?= $val; ?>
                                                            </span> </span>
                                                    </a>
                                                </li>
        <?php }
    } ?>
                                    </ul><div class="slimScrollBar" style="background: rgb(99, 114, 131) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 121.359px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                            </li>
                        </ul>
                    </li>
<?php } ?>

                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <?php
                        if (!empty($userData['profile_pic']))
                            echo $this->Html->image('/uploads/users/' . $userData['profile_pic'], ["class" => "user-image", "alt" => "User Image"]);
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
            </ul>
        </div>
    </nav>
</header>
<script type="text/javascript">
    $(window).scroll(function () {
        var aTop = $('.content-wrapper').height();
        alert();
        if ($(this).scrollTop() >= aTop) {
             // something like $('#footAd').slideup();
        }
    });
</script>
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