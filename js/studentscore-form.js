$(document).ready(function () {
    $("tr[data-toggle=studentscore-row] td a[data-score-start-edit]").click(function (e) {
        e.preventDefault();
        var valuesTr = $(this).parent().parent();
        var scoreId = valuesTr.data("studentscore-id");
        var studentId = valuesTr.children("td[data-id=student]").data("value");
        var present = valuesTr.children("td[data-id=present]").data("value");
        var score = valuesTr.children("td[data-id=score]").text();
        $("#editScore select[name=studentId] option[value="+studentId+"]").prop('selected', true);
        $("#editScore input[name=scoreId]").val(scoreId);
        $("#editScore input[name=present]").prop('checked', present);
        $("#editScore input[name=score]").val(score);
    });
    $("a[data-submit]").click(function(e){
        e.preventDefault();
        var form = $(this).closest("form");
        var scoreInput = form.find("input[name=score]");
        var score = scoreInput.val();
        var maxScore = $("[data-max-score]").data("max-score");
        if(score > maxScore){
            var row = scoreInput.closest("div.form-group");
            row.toggleClass("has-error");
        }else {
            form.submit();
        }
    });
});
