google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(loadAndDraw);

var loadedData = [];

function drawChart(roundFactor) {
    var data = new google.visualization.DataTable();
    data.addColumn('number', 'Note');
    data.addColumn('number', 'Anzahl');
    data.addRows(prepareChartsData(loadedData,roundFactor));

    var ticks = [];
    for (i = 1; i <= (6 * roundFactor); i++) {
        ticks[i - 1] = i / (6 * roundFactor) * 6;
    }
    var number = 1 / roundFactor;
    var options = {
        height:500,
        hAxis: {
            title: 'Note',
            ticks: ticks,
            viewWindow: {
                min: [1 - (1 / roundFactor) / 2],
                max: [6 + (1 / roundFactor) / 2]
            },
            textStyle: {
                fontSize: 12 - (roundFactor / 10) * 5
            }
        },
        vAxis: {
            title: 'Anzahl'
        },
        legend: 'none'
    };

    var chart = new google.visualization.ColumnChart(
        document.getElementById('chart_div'));

    chart.draw(data, options);
};

function loadAndDraw() {

    var selectedClassOption = $("select[name=schoolclass] option:selected");

    if (selectedClassOption.length && selectedClassOption.val().length) {
        var jsonData = $.ajax({
            url: "/rest/evaluation?action=scores&schoolclassId=" + selectedClassOption.val(),
            dataType: "json"
        }).done(function (data, textStatus) {
            loadedData = data;
            var roundFactor = $("select[name=roundFactor] option:selected").val();
            drawChart(roundFactor);
        }).fail(function () {
            alert("Es ist ein Fehler aufgetreten");
        });

        return jsonData;
    }
};

function prepareChartsData(jsonData, factor) {
    var withStatistic = jsonData.reduce(function (last, current) {
        current = Math.round(current*factor)/factor;
        last[current] = (current in last) ? last[current] + 1 : 1;
        return last;
    }, {});
    return $.map(withStatistic,function(element,index){
        return [[parseFloat(index),parseInt(element)]];
    }).sort(function(array,other){
        return array[0]-other[0];
    });
};

function drawWithDifferentFactor(){
    var roundFactor = $("select[name=roundFactor] option:selected").val();
    drawChart(roundFactor);
}

$(document).ready(function () {
    $("select[name=schoolclass]").change(loadAndDraw);
    $("select[name=roundFactor]").change(drawWithDifferentFactor);
});