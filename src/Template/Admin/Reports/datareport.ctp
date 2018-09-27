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
    <?= $this->Html->link(__('<i class="fa fa-file-excel-o"></i> Excel'), ['action' => 'dataexport'], ['class' => 'btn btn-success btn-sm','style'=>'float:right;' ,'escape' => false]) ?>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php echo $this->Flash->render(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h3>Data Report</h3>
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
        
        data.addColumn('string', 'data');
        data.addColumn('number', 'Distribution of profits to customers');
        data.addColumn('string', 'Distribution of profits to Leader');
        data.addColumn('string', 'Leader fee');
        data.addColumn('string', 'Type of commission: buy / sell');
        data.addColumn('string', 'Purchase');
        data.addColumn('number', 'sale');
        data.addColumn('string', 'Brokerage fee for average transaction');
        data.addRows([
          ['data', 10000, '5%','60%','Buy','1000',897,'45,000'],
          ['data', 10000, '5%','60%','Buy','1000',897,'45,000'],
          ['data', 10000, '5%','60%','Buy','1000',897,'45,000'],
          ['data', 10000, '5%','60%','Buy','1000',897,'45,000'],
          ['data', 10000, '5%','60%','Buy','1000',897,'45,000'],
         
        ]);

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
      }
    </script>