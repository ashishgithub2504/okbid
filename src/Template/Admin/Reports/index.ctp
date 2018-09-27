<?php
/**
  * @var \App\View\AppView $this
  */
?>
<section class="content-header">
    <h1>
        Manage Reports
        <small>All Reports List</small>
    </h1>
    <?= $this->Html->link(__('<i class="fa fa-file-excel-o"></i> Excel'), ['action' => 'export'], ['class' => 'btn btn-success btn-sm','style'=>'float:right;' ,'escape' => false]) ?>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php echo $this->Flash->render(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h3>Profit Sharing Report</h3>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <div id="table_div"></div>
                    
            <!-- /.box -->
        </div>
    </div>
</section>
<script type="text/javascript">
          google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);

      function drawTable() {
        var data = new google.visualization.DataTable();
        
        data.addColumn('string', 'Amount payable for the current quarter');
        data.addColumn('number', 'Credits');
        data.addColumn('boolean', 'Entitlement');
        data.addColumn('string', '2%');
        data.addColumn('string', 'sale');
        data.addColumn('string', '5 years');
        data.addColumn('number', 'Amount of profit distribution ');
        data.addRows([
          ['Mike',  {v: 10000, f: '$10,000'}, true,'לא','כן','כן',897],
          ['John',  {v: 10000, f: '$10,000'}, true,'לא','כן','כן',897],
          ['smith',  {v: 10000, f: '$10,000'}, true,'לא','כן','כן',897],
          ['Arnav',  {v: 10000, f: '$10,000'}, true,'לא','כן','כן',897],
          ['Rahul',  {v: 10000, f: '$10,000'}, true,'לא','כן','כן',897],
          ['Sunil',  {v: 10000, f: '$10,000'}, true,'לא','כן','כן',897],
         
        ]);

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
      }
    </script>