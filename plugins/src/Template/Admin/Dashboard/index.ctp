<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
</section>
<!-- Main content -->
<section class="content">

    <!-- Small boxes (Start box) -->
    <div class="row">

        <?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('1', '5', '3', '4', '6'))) { ?>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-orange">
                    <div class="inner">
                        <h3><?= $pending; ?></h3>
                        <p>Total Pending Properties</p>
                    </div>
                    <div class="icon">
                        <i class="ion-ios-people"></i>
                    </div>
                    <?php echo $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>', ['controller' => 'properties', 'action' => 'index'], ['escape' => false, 'class' => 'small-box-footer']); ?>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?= $onsale; ?></h3>
                        <p>Total For Sale Properties</p>
                    </div>
                    <div class="icon">
                        <i class="ion-ios-people"></i>
                    </div>
                    <?php echo $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>', ['controller' => 'properties', 'action' => 'sale'], ['escape' => false, 'class' => 'small-box-footer']); ?>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green" >
                    <div class="inner">
                        <h3><?= $sold; ?></h3>
                        <p>Total Sold Properties</p>
                    </div>
                    <div class="icon">
                        <i class="ion-ios-people"></i>
                    </div>
                    <?php echo $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>', ['controller' => 'properties', 'action' => 'sold'], ['escape' => false, 'class' => 'small-box-footer']); ?>
                </div>
            </div>
        
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-blue" >
                    <div class="inner">
                        <h3><?= $auction; ?></h3>
                        <p>Total Inactive Properties</p>
                    </div>
                    <div class="icon">
                        <i class="ion-ios-people"></i>
                    </div>
                    <?php echo $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>', ['controller' => 'properties', 'action' => 'inactive'], ['escape' => false, 'class' => 'small-box-footer']); ?>
                </div>
            </div>
        <?php }

        if (in_array($this->request->session()->read('Auth.admin.role_id'), array('3'))) {
            ?>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-teal" >
                    <div class="inner">
                        <h3><?= count($assignproty); ?></h3>
                        <p>Total Assign Properties</p>
                    </div>
                    <div class="icon">
                        <i class="ion-ios-people"></i>
                    </div>
    <?php echo $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>', ['controller' => 'properties', 'action' => 'assignpro'], ['escape' => false, 'class' => 'small-box-footer']); ?>
                </div>
            </div>

        <?php }

        if (in_array($this->request->session()->read('Auth.admin.role_id'), array('1', '5'))) {
            ?>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-teal" >
                    <div class="inner">
                        <h3><?= $count_users ?></h3>
                        <p>Total Sellers \ Buyers  </p>
                    </div>
                    <div class="icon">
                        <i class="ion-ios-people"></i>
                    </div>
    <?php echo $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>', ['controller' => 'users', 'action' => 'index'], ['escape' => false, 'class' => 'small-box-footer']); ?>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3><?= $leader_users ?></h3>
                        <p>Total Leaders</p>
                    </div>
                    <div class="icon">
                        <i class="ion-ios-people"></i>
                    </div>
    <?php echo $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>', ['controller' => 'users', 'action' => 'leader'], ['escape' => false, 'class' => 'small-box-footer']); ?>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box  bg-lime" >
                    <div class="inner">
                        <h3><?= $agent_users ?></h3>
                        <p>Total Agents</p>
                    </div>
                    <div class="icon">
                        <i class="ion-ios-people"></i>
                    </div>
    <?php echo $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>', ['controller' => 'users', 'action' => 'agent'], ['escape' => false, 'class' => 'small-box-footer']); ?>
                </div>
            </div>
             <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-fuchsia" >
                    <div class="inner">
                        <h3><?= $building_users ?></h3>
                        <p>Total Building contractors</p>
                    </div>
                    <div class="icon">
                        <i class="ion-ios-people"></i>
                    </div>
            <?php echo $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>', ['controller' => 'users', 'action' => 'contractor'], ['escape' => false, 'class' => 'small-box-footer']); ?>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow" >
                    <div class="inner">
                        <h3><?= $manager_users ?></h3>
                        <p>Total Managers</p>
                    </div>
                    <div class="icon">
                        <i class="ion-ios-people"></i>
                    </div>
    <?php echo $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>', ['controller' => 'users', 'action' => 'manager'], ['escape' => false, 'class' => 'small-box-footer']); ?>
                </div>
            </div>
           
        <?php } ?>

        <?php
        if (in_array($this->request->session()->read('Auth.admin.role_id'), array('6'))) {
            if (!empty($projects)) {
                foreach ($projects as $key => $val) {
                    ?>
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-teal" >
                            <div class="inner">
                                <h3></h3>
                                <p><?= ucfirst($val['name']).' Project'; ?></p>
                            </div>
                            <div class="icon">
                                <i class="ion-ios-people"></i>
                            </div>
                    <?php echo $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>', ['controller' => 'properties', 'action' => 'project',$val->id], ['escape' => false, 'class' => 'small-box-footer']); ?>
                        </div>
                    </div>
        <?php
        }
    }
}
?>

        <!--        <div class="col-lg-3 col-xs-6">
                     small box 
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3><?= $count_emailtemplates ?></h3>
        
                            <p>Email Templates</p>
                        </div>
                        <div class="icon">
                            <i class="ion-ios-email"></i>
                        </div>
<?php //echo $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>', ['controller' => 'email_templates', 'action' => 'index'], ['escape' => false, 'class' => 'small-box-footer']);  ?>
                    </div>
                </div>-->
    </div>
    <!-- /.row -->

</section>
