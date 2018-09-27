<?php
if (!empty($this->request->action))
    $url = $this->request->action;
else
    $url = '';
$ctrl = strtolower($this->request->controller);

//pr($this->request->session()->read('Auth.admin.role_id'));
//die;
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

            <li class="<?php echo (($url == "index") && $ctrl == "dashboard") ? "active" : ""; ?>">
                <?php
                echo $this->Html->link("<i class=\"fa fa-dashboard\"></i> <span>Dashboard</span>", ["controller" => "dashboard", "action" => "index"], ["class" => "", "escape" => false]);
                ?>
            </li>




            <li class="<?php echo (($url == "index" || $url == "view" || $url == "add" || $url == "edit" || $url == "sold" || $url == "sale" || $url == "inactive" || $url == "assignpro" || $url == "graph" ) && $ctrl == "properties") ? "active treeview" : "treeview"; ?>">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Property Manager</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo ($ctrl == "properties" && $url == "index") ? "active treeview" : "treeview"; ?>"><?php echo $this->Html->link("<i class=\"fa fa-users\"></i> <span>Pending Properties</span>", ["controller" => "properties", "action" => "index"], ["class" => "", "escape" => false]); ?></li>
                    <li class="<?php echo ($ctrl == "properties" && $url == "sale") ? "active treeview" : "treeview"; ?>"><?php echo $this->Html->link("<i class=\"fa fa-users\"></i> <span>Properties For Sale</span>", ["controller" => "properties", "action" => "sale"], ["class" => "", "escape" => false]); ?></li>
                    <li class="<?php echo ($ctrl == "properties" && $url == "sold") ? "active treeview" : "treeview"; ?>"><?php echo $this->Html->link("<i class=\"fa fa-users\"></i> <span>Sold Properties</span>", ["controller" => "properties", "action" => "sold"], ["class" => "", "escape" => false]); ?></li>
                    <li class="<?php echo ($ctrl == "properties" && $url == "inactive") ? "active treeview" : "treeview"; ?>"><?php echo $this->Html->link("<i class=\"fa fa-users\"></i> <span>Inactive Properties</span>", ["controller" => "properties", "action" => "inactive"], ["class" => "", "escape" => false]); ?></li>
                    <?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('3'))) { ?>
                        <li class="<?php echo ($ctrl == "properties" && $url == "assignpro") ? "active treeview" : "treeview"; ?>"><?php echo $this->Html->link("<i class=\"fa fa-users\"></i> <span>Assign Properties</span>", ["controller" => "properties", "action" => "assignpro"], ["class" => "", "escape" => false]); ?></li>
                    <?php } ?>

                </ul>
            </li>

            <?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('1', '5'))) { ?>


                <li class="<?php echo (($url == "index" || $url == "leader" || $url == "agent" || $url == "manager" || $url == "contractor" || $url == "view" || $url == "add" || $url == "edit" ) && $ctrl == "users") ? "active treeview" : "treeview"; ?>">
                    <a href="#">
                        <i class="fa fa-pie-chart"></i>
                        <span>Users Management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php echo ($ctrl == "users" && $url == "index") ? "active treeview" : "treeview"; ?>"><?php echo $this->Html->link("<i class=\"fa fa-users\"></i> <span>Sellers / buyers</span>", ["controller" => "users", "action" => "index"], ["class" => "", "escape" => false]); ?></li>
                        <li class="<?php echo ($ctrl == "users" && $url == "leader") ? "active treeview" : "treeview"; ?>"><?php echo $this->Html->link("<i class=\"fa fa-users\"></i> <span>Leaders</span>", ["controller" => "users", "action" => "leader"], ["class" => "", "escape" => false]); ?></li>
                        <li class="<?php echo ($ctrl == "users" && $url == "agent") ? "active treeview" : "treeview"; ?>"><?php echo $this->Html->link("<i class=\"fa fa-users\"></i> <span>Agents</span>", ["controller" => "users", "action" => "agent"], ["class" => "", "escape" => false]); ?></li>
                        <li class="<?php echo ($ctrl == "users" && $url == "contractor") ? "active treeview" : "treeview"; ?>"><?php echo $this->Html->link("<i class=\"fa fa-users\"></i> <span>Building contractors</span>", ["controller" => "users", "action" => "contractor"], ["class" => "", "escape" => false]); ?></li>
                        <li class="<?php echo ($ctrl == "users" && $url == "manager") ? "active treeview" : "treeview"; ?>"><?php echo $this->Html->link("<i class=\"fa fa-users\"></i> <span>Managers</span>", ["controller" => "users", "action" => "manager"], ["class" => "", "escape" => false]); ?></li>

                    </ul>
                </li>

                <li class="<?php echo (($url == "index" || $url == "view" || $url == "add" || $url == "datareport" ) && $ctrl == "reports") ? "active treeview" : "treeview"; ?>">
                    <a href="#">
                        <i class="fa fa-flag"></i>
                        <span>Report Manager</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php echo ($ctrl == "reports" && $url == "index" ) ? "active treeview" : "treeview"; ?>"><?php echo $this->Html->link("<i class=\"fa fa-flag\"></i> <span>Profit Sharing Report</span>", ["controller" => "reports", "action" => "index"], ["class" => "", "escape" => false]); ?></li>
                        <li class="<?php echo ($ctrl == "reports" && $url == "add" ) ? "active treeview" : "treeview"; ?>"><?php echo $this->Html->link("<i class=\"fa fa-flag\"></i> <span>Leader Income Report</span>", ["controller" => "reports", "action" => "add"], ["class" => "", "escape" => false]); ?></li>
                        <li class="<?php echo ($ctrl == "reports" && $url == "datareport") ? "active treeview" : "treeview"; ?>"><?php echo $this->Html->link("<i class=\"fa fa-flag\"></i> <span>Data Report</span>", ["controller" => "reports", "action" => "datareport"], ["class" => "", "escape" => false]); ?></li>
                    </ul>
                </li>

                <?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('5'))) { ?>
                    <li class="<?php echo ($ctrl == "chats") ? "active" : ""; ?>">
                        <?php
                        echo $this->Html->link("<i class=\"fa fa-fw fa-cog\"></i> <span>Chat Manager</span>", ["controller" => 'chats', 'action' => 'index'], ["class" => "", "escape" => false]);
                        ?>
                    </li>
                <?php } ?>

                
            <?php } ?>



            <?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('1', '6'))) { ?>
                <li class="<?php echo ($ctrl == "projects") ? "active" : ""; ?>">
                    <?php
                    echo $this->Html->link("<i class=\"fa fa-fw fa-cog\"></i> <span>Project  Manager</span>", ["controller" => 'projects', 'action' => 'index'], ["class" => "", "escape" => false]);
                    ?>
                </li>
            <?php } ?>

            <?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('1'))) { ?>

                <li class="<?php echo (($url == "index" || $url == "view" || $url == "add" || $url == "edit" ) && $ctrl == "categories" || $ctrl == "subcategories" || $ctrl == "propertytypes") ? "active treeview" : "treeview"; ?>">
                    <a href="#">
                        <i class="fa fa-pie-chart"></i>
                        <span>Category Manager</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php echo ($ctrl == "categories") ? "active" : ""; ?>">
                            <?php
                            echo $this->Html->link("<i class=\"fa fa-fw fa-cog\"></i> <span>Categories Manager</span>", ["controller" => 'categories', 'action' => 'index'], ["class" => "", "escape" => false]);
                            ?>
                        </li>
                        <li class="<?php echo ($ctrl == "subcategories") ? "active" : ""; ?>">
                            <?php
                            echo $this->Html->link("<i class=\"fa fa-fw fa-cog\"></i> <span>Subcategories Manager</span>", ["controller" => 'subcategories', 'action' => 'index'], ["class" => "", "escape" => false]);
                            ?>
                        </li>
                        <li class="<?php echo ($ctrl == "propertytypes") ? "active" : ""; ?>">
                            <?php
                            echo $this->Html->link("<i class=\"fa fa-fw fa-cog\"></i> <span>Property Types Manager</span>", ["controller" => 'propertytypes', 'action' => 'index'], ["class" => "", "escape" => false]);
                            ?>
                        </li>
                    </ul>
                </li>


            <?php } ?>

            <li class="<?php echo ($ctrl == "propertycommisions") ? "active" : ""; ?>">
                <?php
                echo $this->Html->link("<i class=\"fa fa-fw fa-cog\"></i> <span>Commision Manager</span>", ["controller" => 'property-commisions', 'action' => 'index'], ["class" => "", "escape" => false]);
                ?>
            </li>
            
            <li class="<?php echo (($url == "index") && $ctrl == "settings") ? "active" : ""; ?>">
                <?php
                echo $this->Html->link("<i class=\"fa fa-fw fa-cog\"></i> <span>General Settings</span>", ["controller" => "Settings", "action" => "index"], ["class" => "", "escape" => false]);
                ?>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>