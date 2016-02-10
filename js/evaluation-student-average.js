$(document).ready(function () {
    google.charts.load('current', {packages: ['corechart', 'line']});
    google.charts.setOnLoadCallback(loadDrawAndFillTable);

    var options = {
        height: 500,
        pointSize: 10,
        hAxis: {
            title: 'Tag',
            format: 'd.M.y',
        },
        vAxis: {
            title: 'Note',
            viewWindow: {
                min: 1,
                max: 6
            },
            ticks: [1, 2, 3, 4, 5, 6],
            interpolateNulls: true
        }
    };

    function drawChart(){
        var subjects = $("input[name=subject]:checked");
        var filteredData = filterSubjects(loadedData, subjects);
        if (!filteredData.length){
            clearChart();
            return;
        }


        var data = new google.visualization.DataTable();
        data.addColumn('date', 'Datum');

        var groupedBySubjectData = getGroupedByData('subject', filteredData);

        for (var key in groupedBySubjectData) {
            var scoresOrderedByDate = groupedBySubjectData[key];
            data.addColumn('number', scoresOrderedByDate[0]['subject']);
        }

        var rows = getRows(groupedBySubjectData);
        data.addRows(rows);

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }

    function getGroupedByData(groupBy, data) {
        return data.reduce(function (last, current) {
            var element = current[groupBy];
            if(element in last){
                last[element].push(current);
            } else{
                last[element] = [current];
            }
            return last;
        }, {});
    }

    function filterSubjects(data, subjects) {
        var subjectArray = subjects.map(function(){
            return parseInt($(this).val());
        }).get();
        return data.filter(function (score) {
            return subjectArray.indexOf(score['subjectId']) != -1;
        });
    }

    function getRows(groupedBySubjectData){
        var subjects = $.map(groupedBySubjectData,function(element,index){
            return [index];
        });
        var rows = [];
        for (var key in groupedBySubjectData) {
            var scores = groupedBySubjectData[key];
            var subjectIndex = subjects.indexOf(key)+1;
            scores.forEach(function(score){
                var date = new Date(score['date']);
                var row = [date];
                subjects.forEach(function(){
                    row.push(null);
                });
                row[subjectIndex] = score['evaluatedScore'];
                rows.push(row);
            });
        }
        return rows;
    }

    function clearChart(){
        var data = google.visualization.arrayToDataTable([
            ['', { role: 'annotation' }],
            ['', '']
        ]);
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, {});
    }

    function loadDrawAndFillTable(){
        var selectedStudent = $("select[name=studentId] option:selected");
        if(selectedStudent.length){
            $.ajax({
                url: "/rest/evaluation?action=studentScores&studentId=" + selectedStudent.val(),
                dataType: "json"
            }).done(function (data, textStatus) {
                loadedData = data;
                fillTable();
                drawChart();
            }).fail(function () {
                alert("Es ist ein Fehler aufgetreten");
            });
        }
    }

    function fillTable(){
        var scoreTable = $("#scoreTable");
        scoreTable.find("tbody").empty();
        $.each(loadedData, function( index, value ){
            scoreTable.append("<tr><td>"+value['evaluatedScore']+"</td><td>"+value['date']+"</td><td>"+value['subject']+"</td></tr>")
        });
    }

    $("input[name=subject]").change(drawChart);
    $("select[name=studentId]").change(loadDrawAndFillTable);
});