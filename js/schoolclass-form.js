$( document ).ready(function() {
    var hideInputAndShowHidden = function(e){
        e.preventDefault();
        $("tr[data-edit-hidden]").show();
        $("tr[data-schoolclass-row]").hide();
    };
  $("a[data-toggle=schoolclass-submit]").click(function(e) {
      e.preventDefault();
      var form = $("form[name=school-form]");
      var schoolClassInput = form.find("input[name=schoolclass]");
      if (!schoolClassInput.val().length) {
          schoolClassInput.closest("div.form-group").addClass("has-error");
      } else {
        form.submit();
      }
  });
  
  $("tr[data-toggle=schoolclass-row] td a[data-toggle=schoolclass-start-edit]").click(function(e){
     hideInputAndShowHidden(e);
     var inputTr = $("tr[data-schoolclass-row]");
     var newInputTr = $("tr[data-schoolclass-row]").clone(true);
     inputTr.remove();
     var form = $("form[name=school-form]");
     var actionPrefix = form.data("action-prefix");
     form.attr("action", actionPrefix + "/edit");
     var valuesTr = $(this).parent().parent("tr[data-schoolclass-id]");
     var schoolclass = valuesTr.find("td[data-id=schoolclass] a").text();
     newInputTr.find("td input[name=schoolclass]").val(schoolclass);
     newInputTr.find("td input[name=schoolclass-id]").val(valuesTr.data("schoolclass-id"));
     valuesTr.attr("data-edit-hidden","");
     valuesTr.hide();
     valuesTr.after(newInputTr);
     newInputTr.show();
  });
  
  $("a[data-toggle=schoolclass-start-new]").click(function(e){
     hideInputAndShowHidden(e);
     var inputTr = $("tr[data-schoolclass-row]");
     var newInputTr = $("tr[data-schoolclass-row]").clone(true);
     inputTr.remove();
     newInputTr.find("td input[name=schoolclass]").val("");
     newInputTr.find("td input[name=schoolclass-id]").val("");
     var form = $("form[name=school-form]");
     var actionPrefix = form.data("action-prefix");
     form.attr("action", actionPrefix + "/new");
     $("table[data-toggle=schoolclass-table] tbody").prepend(newInputTr);
     newInputTr.show();
  });
  $("a[data-toggle=schoolclass-abort]").click(hideInputAndShowHidden);
});
