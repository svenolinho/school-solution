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
});
