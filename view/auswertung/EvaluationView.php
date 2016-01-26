<?php

include_once 'view/View.php';
include_once 'index.php';

class EvaluationView extends View {

    public function display() {

     
        echo <<<EVALUATIONCLASSVIEW
    <!--Google Charts-->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load("current", {packages: ["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    ['Work', 11],
                    ['Eat', 2],
                    ['Commute', 2],
                    ['Watch TV', 2],
                    ['Sleep', 7]
                ]);

                var options = {
                    title: 'My Daily Activities',
                    is3D: true,
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                chart.draw(data, options);
            }
            google.charts.setOnLoadCallback(drawChart2);
            function drawChart2() {
                var data2 = google.visualization.arrayToDataTable([
                    ['Age', 'Weight'],
                    [8, 12],
                    [4, 5.5],
                    [11, 14],
                    [4, 5],
                    [3, 3.5],
                    [6.5, 7]
                ]);

                var options = {
                    title: 'Age vs. Weight comparison',
                    hAxis: {title: 'Age', minValue: 0, maxValue: 15},
                    vAxis: {title: 'Weight', minValue: 0, maxValue: 15},
                    legend: 'none'
                };

                var chart2 = new google.visualization.ScatterChart(document.getElementById('chart_div'));

                chart2.draw(data2, options);
            }
        </script>
    <h1>Übersicht Klassen - <small>Hier können Sie Klassen auswerten</small></h1>
    <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
    <h1>Übersicht Studenten - <small>Hier können Sie Studenten auswerten</small></h1>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>

EVALUATIONCLASSVIEW;

    }

}
