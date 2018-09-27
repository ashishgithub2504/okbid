<?php

/**
 * @var \App\View\AppView $this
 */
use Cake\Core\Configure;
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart1);
    function drawChart1() {
        var data = google.visualization.arrayToDataTable
                ([['X', 'Y', {'type': 'string', 'role': 'style'}],
                    [0, 0, null],
                    [2, 2.5, null],
                    [3, 3, null],
                    [4, 4, null],
                    [5, 4, null],
                    [6, 3, 'point { size: 18; shape-type: star; fill-color: #a52714; }'],
                    [7, 2.5, null],
                    [8, 3, null]
                ]);
        var options = {
            title: 'World Population Since 1400 A.D. in Log Scale',
            legend: 'none',
            hAxis: {minValue: 0, maxValue: 9},
            vAxis: {
                title: 'Population (millions)',
                ticks: [0, 1000, 2000, 4000, 6000]
            },
            curveType: 'function',
            pointSize: 7,
            dataOpacity: 0.3
        };
        var chart = new google.visualization.LineChart(document.getElementById('chart_div1'));
        chart.draw(data, options);
    }

    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable
                ([['Time', 'Bid', {'type': 'string', 'role': 'style'}],
                    [4, 0, null],
                    [4.30, 300, null],
                    [5, 400, null],
                    [5.30, 500, null],
                    [6, 550, null],
                    [6.30, 600, null],
                    [7, 800, null]
                ]);
        var options = {
            title: 'City, Proprty type, 3 Room',
            legend: 'none',
            vAxis: {
                title: 'Bid (price)',
                ticks: [0, 100, 200, 400, 600,800,1000]
            },
            hAxis:{
              title:'Time',
              ticks:[4.00,4.30,5.00,5.30,6.00,6.30,7.00,7.30]
            },
            curveType: 'function',
            pointSize: 12
        };
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
</head>
<body>
    <div id="chart_div" style="width: 1200px; height: 500px"></div>
    <div class="box-body table-responsive" style="background-color:  #fff ">
        <table class="table table-hover">
            <tbody>
                <tr>
                    <td style="width: 20%">Number of views :</td><td>200</td>
                </tr>
                <tr>
                    <td>Number of Signatures :</td><td>125</td>
                </tr>
                <tr>
                    <td>Number of bids :</td><td>95</td>
                </tr>
                <tr>
                    <td>Minumum price :</td><td>£2000</td>
                </tr>
                <tr>
                    <td>Highest price:</td><td>£15000</td>
                </tr>

            </tbody>

        </table>
    </div>
</body>