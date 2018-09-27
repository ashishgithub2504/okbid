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
    <?= $this->Html->link(__('<i class="fa fa-file-excel-o"></i> Excel'), ['action' => 'leaderexport'], ['class' => 'btn btn-success btn-sm','style'=>'float:right;' ,'escape' => false]) ?>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php echo $this->Flash->render(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h3>Leader Income Report</h3>
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
        
        data.addColumn('string', 'company');
        data.addColumn('number', 'Master fee including VAT');
        data.addColumn('boolean', 'Leaders commission including VAT');
        data.addColumn('string', 'Distributing top profits to a leaders');
        data.addColumn('string', 'Distribution of profits to customers (after reduction 17 + 25)');
        data.addColumn('string', 'Commission before VAT');
        data.addColumn('number', 'The value of the commission includes VAT');
        data.addColumn('number', 'Invoice number');
        data.addRows([
          ['Mike',  {v: 10000, f: '$10,000'}, true,'לא','כן','כן',897,3515],
          ['John',  {v: 10000, f: '$10,000'}, true,'לא','כן','כן',897,3517],
          ['smith',  {v: 10000, f: '$10,000'}, true,'לא','כן','כן',897,3518],
          ['Arnav',  {v: 10000, f: '$10,000'}, true,'לא','כן','כן',897,3519],
          ['Rahul',  {v: 10000, f: '$10,000'}, true,'לא','כן','כן',897,3520],
          ['Sunil',  {v: 10000, f: '$10,000'}, true,'לא','כן','כן',897,3521],
         
        ]);

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
      }
    </script>