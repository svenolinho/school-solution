$(document).ready(function () {
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(loadAndDraw);

    var options = {
        title: 'Vergleich von Klassenschnitt pro Fach',
        height:500,
        hAxis: {
            title: 'Fächer',
        },
        vAxis: {
            title: 'Notenschnitt gesamt',
            viewWindow: {
                min: 1,
                max: 6
            },
            ticks: [1,2,3,4,5,6]
        }
    };

    function drawChart(data){
        var data = new google.visualization.DataTable(data);
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }

    function clearChart(){
        var data = google.visualization.arrayToDataTable([
            ['', { role: 'annotation' }],
            ['', '']
        ]);
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, {});
    }

    function loadAndDraw(){
        var classes = $("input[name=class]:checked");
        var classParameters = "";
        if(classes.length){
            classParameters += "&classes[]="+classes.map(function(){
                    return $(this).val();
                }).get().join("&classes[]=");
        }
        var subjects = $("input[name=subject]:checked");
        var subjectParameters = "";
        if(subjects.length){
            subjectParameters += "&subjects[]="+subjects.map(function(){
                    return $(this).val();
                }).get().join("&subjects[]=");
        }

        if(classes.length && subjects.length){
            $.ajax({
                url: "/rest/evaluation?action=scoreComparison"+ classParameters + subjectParameters,
                dataType: "json"
            }).done(function (data, textStatus) {
                drawChart(data);
            }).fail(function () {
                alert("Es ist ein Fehler aufgetreten");
            });
        }else{
            clearChart();
        }
    }

    $("input[name=class]").change(loadAndDraw);
    $("input[name=subject]").change(loadAndDraw);
});