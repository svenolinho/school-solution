$( document ).ready(function() {
    var hideInputAndShowHidden = function(e){
        e.preventDefault();
        $("tr[data-edit-hidden]").show();
        $("tr[data-schoolsubject-row]").hide();
    };
  $("a[data-toggle=schoolsubject-submit").click(function(e){
      e.preventDefault();
      $("form[name=school-form]").submit();
  });
  
  $("tr[data-toggle=schoolsubject-row] td a[data-toggle=schoolsubject-start-edit]").click(function(e){
     hideInputAndShowHidden(e);
     var inputTr = $("tr[data-schoolsubject-row]");
     var newInputTr = $("tr[data-schoolsubject-row]").clone(true);
     inputTr.remove();
     var form = $("form[name=school-form]");
     var actionPrefix = form.data("action-prefix");
     form.attr("action", actionPrefix + "/edit");
     var valuesTr = $(this).parent().parent("tr[data-schoolsubject-id]");
     var schoolsubject = valuesTr.find("td[data-id=schoolsubject] a").text();
     newInputTr.find("td input[name=schoolsubject]").val(schoolsubject);
     newInputTr.find("td input[name=schoolsubject-id]").val(valuesTr.data("schoolsubject-id"));
     valuesTr.attr("data-edit-hidden","");
     valuesTr.hide();
     valuesTr.after(newInputTr);
     newInputTr.show();
  });
  
  $("a[data-toggle=schoolsubject-start-new]").click(function(e){
     hideInputAndShowHidden(e);
     var inputTr = $("tr[data-schoolsubject-row]");
     var newInputTr = $("tr[data-schoolsubject-row]").clone(true);
     inputTr.remove();
     newInputTr.find("td input[name=schoolsubject]").val("");
     newInputTr.find("td input[name=schoolsubject-id]").val("");
     var form = $("form[name=school-form]");
     var actionPrefix = form.data("action-prefix");
     form.attr("action", actionPrefix + "/new");
     $("table[data-toggle=schoolsubject-table] tbody").prepend(newInputTr);
     newInputTr.show();
  });
  $("a[data-toggle=schoolsubject-abort]").click(hideInputAndShowHidden);
});
