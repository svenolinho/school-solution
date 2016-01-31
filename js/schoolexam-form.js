$(document).ready(function () {
    $("tr[data-toggle=schoolexam-row] td a[data-schoolexam-start-edit]").click(function (e) {
        e.preventDefault();
        var selectedExamId = $(this).parent().parent("tr[data-schoolexam-id]").data("schoolexam-id");
        var selectedExam = examsData[selectedExamId];
        $("#editExam input[name=examId]").val(selectedExamId);
        $("#editExam select[name=schoolClass] option[value="+selectedExam['schoolClassId']+"]").prop('selected', true);
        $("#editExam select[name=subject] option[value="+selectedExam['subjectId']+"]").prop('selected', true);
        $("#editExam input[name=date]").val(selectedExam['date']);
        $("#editExam input[name=clef]").val(selectedExam['clef']);
        $("#editExam input[name=maxScore]").val(selectedExam['maxScore']);
    });
    $("a[data-submit]").click(function(e){
        e.preventDefault();
        var form = $(this).closest("form");
        form.find("div.form-group").removeClass("has-error");
        var dateInput = form.find("input[name=date]");
        if(!dateInput.val()){
            dateInput.closest("div.form-group").addClass("has-error");
        }
        var clefInput = form.find("input[name=clef]");
        var clef = clefInput.val();
        $.ajax({
            url: "/rest/exams/validateClef?clef="+encodeURIComponent(clef),
        }).done(function() {
            form.submit();
        }).fail(function(){
            clefInput.closest("div.form-group").addClass("has-error");
        });
    });
});
