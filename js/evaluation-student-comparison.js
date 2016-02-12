$(document).ready(function () {
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(initChart);

    var options = {
        title: 'Vergleich von Notenschnitt der Studenten',
        height: 500,
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

    function initChart(){
        $("select[name=schoolclass]").change(loadStudents);
        loadStudents();
    }

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
        var students = $("input[name=student]:checked");
        var studentsParameters = "";
        if(students.length){
            studentsParameters += "&students[]="+students.map(function(){
                    return $(this).val();
                }).get().join("&students[]=");
        }

        if(students.length){
            $.ajax({
                url: "/rest/evaluation?action=studentComparison" + studentsParameters,
                dataType: "json"
            }).done(function (data, textStatus) {
                drawChart(data);
            }).fail(function () {
                alert("Es ist ein Fehler aufgetreten");
            });
        } else{
            clearChart();
        }
    }

    function loadStudents(){
        clearChart();
        $("input[name=toggleAll]").prop('checked', false);
        var selectedClass = $("select[name=schoolclass] option:selected");

        if(selectedClass.length){
            $.ajax({
                url: "/rest/evaluation?action=getStudents&schoolclassId="+ selectedClass.val(),
                dataType: "json"
            }).done(function (data, textStatus) {
                fillStudentInputs(data);
            }).fail(function () {
                alert("Es ist ein Fehler aufgetreten");
            });
        }
    }

    function fillStudentInputs(data){
        var studentInputs = $("#studentInputs");
        studentInputs.empty();
        $.each(data, function( index, value ){
            studentInputs.append("<label class='checkbox-inline'><input type='checkbox' name='student' value='"+value['id']+"'\>"+value['name']+"</label>")
        });
        $("input[name=student]").change(loadAndDraw);
        $("input[name=student]").change(toggleAllUnselecter);
    }

    function toggleAllUnselecter(){
        if($("input[name=toggleAll]").is(':checked') && $("input[name=student]:not(:checked)").length){
            $("input[name=toggleAll]").prop('checked', false);
        }
    }

    $("input[name=toggleAll]").change(function(){
        $("input[name=student]").prop('checked', $("input[name=toggleAll]").is(':checked'));
        loadAndDraw();
    });
});