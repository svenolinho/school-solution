google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(loadAndDraw);

function drawChart(preparedData) {
    var data = new google.visualization.DataTable();
    data.addColumn('date', 'Datum');
    data.addColumn('number', 'Durchschnitt');
    data.addRows(preparedData);

    var options = {
        height: 500,
        curveType: 'function',
        pointSize: 10,
        hAxis: {
            title: 'Tag',
            format: 'd.M.y'
        },
        vAxis: {
            title: 'Note',
            viewWindow: {
                min: 1,
                max: 6
            },
            ticks: [1, 2, 3, 4, 5, 6]
        }
    };

    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

    chart.draw(data, options);
}
function loadAndDraw() {
    var selectedClassOption = $("select[name=schoolclass] option:selected");

    if (selectedClassOption.length && selectedClassOption.val().length) {
        $.ajax({
            url: "/rest/evaluation?action=scoreAverages&schoolclassId=" + selectedClassOption.val(),
            dataType: "json"
        }).done(function (data, textStatus) {
            var preparedData = prepareChartsData(data);
            drawChart(preparedData);
        }).fail(function () {
            alert("Es ist ein Fehler aufgetreten");
        });
    }
}

function prepareChartsData(jsonData) {
    return jsonData.map(function (val) {
        var date = new Date(val[0]);
        return [date, val[1]];
    });
};

$(document).ready(function () {
    $("select[name=schoolclass]").change(loadAndDraw);
});