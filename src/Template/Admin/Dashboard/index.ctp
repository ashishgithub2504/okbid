<section class="content-header">
    <h1>
        Dashboard
    </h1>
</section>
<!-- Main content -->
<section class="content">

    <!-- Small boxes (Start box) -->
    <div class="row card">

        <?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('1', '5', '3', '4', '6'))) { ?>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-orange">
                    <div class="inner">
                        <h3><?= $pending; ?></h3>
                        <p><?= __('Total Pending Properties'); ?></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-home"></i>
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
                        <i class="fa fa-home"></i>
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
                        <i class="fa fa-home"></i>
                    </div>
                    <?php echo $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>', ['controller' => 'properties', 'action' => 'sold'], ['escape' => false, 'class' => 'small-box-footer']); ?>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-blue" >
                    <div class="inner">
                        <h3><?= $inactive; ?></h3>
                        <p>Total Inactive Properties</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-home"></i>
                    </div>
                    <?php echo $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>', ['controller' => 'properties', 'action' => 'inactive'], ['escape' => false, 'class' => 'small-box-footer']); ?>
                </div>
            </div>
			
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-olive" >
                    <div class="inner">
                        <h3><?= $auction; ?></h3>
                        <p>Total Auction Properties</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-home"></i>
                    </div>
                    <?php echo $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>', ['controller' => 'properties', 'action' => 'auction'], ['escape' => false, 'class' => 'small-box-footer']); ?>
                </div>
            </div>

            <?php
        }

        if (in_array($this->request->session()->read('Auth.admin.role_id'), array('3'))) {
            ?>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-teal" >
                    <div class="inner">
                        <h3><?= $myassign; ?></h3>
                        <p>Assign Properties</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-home"></i>
                    </div>
                    <?php echo $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>', ['controller' => 'properties', 'action' => 'assignpro'], ['escape' => false, 'class' => 'small-box-footer']); ?>
                </div>
            </div>

            <?php
        }

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
        
            <?php if (in_array($this->request->session()->read('Auth.admin.role_id'), array('1'))) { ?>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow margin0">
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
			
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-maroon" >
                    <div class="inner">
                        <h3><?= $total_projects; ?></h3>
                        <p>Total Project</p>
                    </div>
                    <div class="icon">
                        <i class="ion-ios-home"></i>
                    </div>
                    <?php echo $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>', ['controller' => 'projects', 'action' => 'index'], ['escape' => false, 'class' => 'small-box-footer']); ?>
                </div>
            </div>

            <?php } ?>

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
                                <p><?= ucfirst($val['name']) . ' Project'; ?></p>
                            </div>
                            <div class="icon">
                                <i class="ion-ios-home"></i>
                            </div>
                            <?php echo $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>', ['controller' => 'properties', 'action' => 'project', $val->id], ['escape' => false, 'class' => 'small-box-footer']); ?>
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
        <?php //echo $this->Html->link('More info <i class="fa fa-arrow-circle-right"></i>', ['controller' => 'email_templates', 'action' => 'index'], ['escape' => false, 'class' => 'small-box-footer']);   ?>
                    </div>
                </div>-->
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Total Pending Properties',     <?= $pending; ?>],
          ['Total For Sale Properties',      <?= $onsale; ?>],
          ['Total Sold Properties',  <?= $sold; ?>],
          ['Total Inactive Properties', <?= $inactive; ?>]
        ]);

        var options = {
          title: 'Property Graph'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

    <div id="piechart" class="card"></div>


</section>
<style type="text/css">
.card{
    background: #fff;
    min-height: 10px 50px;
    box-shadow: 0 12px 10px rgba(0, 0, 0, 0.2);
    position: relative;
    margin: 5px;
	padding:20px 5px 5px 5px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    -ms-border-radius: 2px;
    border-radius: 2px;
}
</style>