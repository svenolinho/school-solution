google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {

    var selectedClassOption = $("select[name=schoolclass] option:selected");

    function prepareChartsData(jsonData) {
        var withStatistic = jsonData.reduce(function (last, current) {
            last[current] = (current in last) ? last[current] + 1 : 1;
            return last;
        }, {});
        return $.map(withStatistic,function(element,index){
            return [[parseFloat(index),parseInt(element)]];
        }).sort(function(array,other){
            return array[0]-other[0];
        });
    }

    if (selectedClassOption.length && selectedClassOption.val().length) {
        var jsonData = JSON.parse($.ajax({
            url: "/rest/evaluation?schoolclassId=" + selectedClassOption.val(),
            dataType: "json",
            async: false
        }).responseText);

        var preparedData = prepareChartsData(jsonData);
        var data = new google.visualization.DataTable();
        data.addColumn('number', 'Note');
        data.addColumn('number', 'Anzahl');
        data.addRows(preparedData);

        var options = {
            title: 'Notenverteilung',
            hAxis: {
                title: 'Note',
                ticks: [1, 2, 3, 4, 5, 6],
                viewWindow: {
                    min: [0.5],
                    max: [6.5]
                }
            },
            vAxis: {
                title: 'Anzahl'
            }
        };

        var chart = new google.visualization.ColumnChart(
            document.getElementById('chart_div'));

        chart.draw(data, options);
    }

};
$(document).ready(function () {
    $("select[name=schoolclass]").change(drawBasic);
});