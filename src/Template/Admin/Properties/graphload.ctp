<?php

/**
 * @var \App\View\AppView $this
 */
use Cake\Core\Configure;

?>
<?php
    $title = $result['city'].',';
    if ($result['propertytype_id'] != 0) {
        $title .= $this->Custom->getPropertyType($result['propertytype_id']);
    }
    $title .= ' ,' . $result['no_of_room'] . ' Rooms';
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    <?php if(!empty($result['property_bids'])){ ?>
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    <?php } ?>
    function drawChart() {
        var data = google.visualization.arrayToDataTable
                ([['Time', 'Bid', {'type': 'string', 'role': 'style'}],
                    <?php if(!empty($result['property_bids'])){
                        foreach($result['property_bids'] as $key=>$val){
                          
                        ?>
                        [new Date(0,0,0,<?= date('h',strtotime($val['created'])).','.date('i',strtotime($val['created'])).','.date('s',strtotime($val['created'])); ?>), <?= $val['price']; ?>, null],
                    <?php } } ?>
                    
                ]);
        var options = {
            title: '<?php echo $title; ?>',
            legend: 'none',
            vAxis: {
                title: 'Bid (price)',
                //ticks: [0, 100, 200, 400, 600,800,1000]
            },
            hAxis:{
              title:'Time',
              //ticks:[4.00,4.30,5.00,5.30,6.00,6.30,7.00,7.30]
            },
            curveType: 'function',
            pointSize: 12
        };
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
</head>
<div id="chart_div" style="width: 1200px; height: 500px; background-color: #fff"><p class="col-sm-12">No bid avalible now</p></div>
    <div class="box-body table-responsive" style="background-color:  #fff ">
        <table class="table table-hover">
            <tbody>
                <tr>
                    <td style="width: 20%">Number of views :</td><td><?= $result['property_view_count']; ?></td>
                </tr>
                <tr>
                    <td>Number of Signatures :</td><td><?= $result['property_signature_count']; ?></td>
                </tr>
                <tr>
                    <td>Number of bids :</td><td><?= $result['property_bid_count']; ?></td>
                </tr>
                <tr>
                    <td>Minumum price :</td><td><?= $result['price']; ?></td>
                </tr>
                <tr>
                    <td>Highest price:</td><td><?= $result['updated_price']; ?></td>
                </tr>

            </tbody>

        </table>
    </div>