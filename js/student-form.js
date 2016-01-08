$( document ).ready(function() {
    var hideInputAndShowHidden = function(e){
        e.preventDefault();
        $("tr[data-edit-hidden]").show();
        $("tr[data-student-row]").hide();
    };
  $("a[data-toggle=student-submit").click(function(e){
      e.preventDefault();
      $("form[name=student-form]").submit();
  });
  
  $("tr[data-toggle=student-row] td a[data-toggle=student-start-edit]").click(function(e){
     hideInputAndShowHidden(e);
     var inputTr = $("tr[data-student-row]");
     var newInputTr = $("tr[data-student-row]").clone(true);
     inputTr.remove();
     var form = $("form[name=student-form]");
     var actionPrefix = form.data("action-prefix");
     form.attr("action", actionPrefix + "/edit");
     var valuesTr = $(this).parent().parent("tr[data-student-id]");
     var firstname = valuesTr.children("td[data-id=firstname]").text();
     var lastname = valuesTr.children("td[data-id=lastname]").text();
     var email = valuesTr.children("td[data-id=email]").text();
     var phone = valuesTr.children("td[data-id=phone]").text();
     var klasse = valuesTr.children("td[data-id=klasse]").data("value");
     newInputTr.find("td input[name=firstname]").val(firstname);
     newInputTr.find("td input[name=lastname]").val(lastname);
     newInputTr.find("td input[name=email]").val(email);
     newInputTr.find("td input[name=phone]").val(phone);
     
     if(klasse){
        newInputTr.find("td select[name=klasse]").val(klasse);
    }
    
     newInputTr.find("td input[name=student-id]").val(valuesTr.data("student-id"));
     valuesTr.hide();
     valuesTr.attr("data-edit-hidden","");
     valuesTr.after(newInputTr);
     newInputTr.show();
  });
  
  $("a[data-toggle=student-start-new]").click(function(e){
     hideInputAndShowHidden(e);
     var inputTr = $("tr[data-student-row]");
     var newInputTr = $("tr[data-student-row]").clone(true);
     inputTr.remove();
     newInputTr.find("td input[name=firstname]").val("");
     newInputTr.find("td input[name=lastname]").val("");
     newInputTr.find("td input[name=email]").val("");
     newInputTr.find("td input[name=phone]").val("");
     newInputTr.find("td input[name=student-id]").val("");
     var form = $("form[name=student-form]");
     var actionPrefix = form.data("action-prefix");
     form.attr("action", actionPrefix + "/new");
     $("table[data-toggle=student-table] tbody").prepend(newInputTr);
     newInputTr.show();
  });
  $("a[data-toggle=student-abort]").click(hideInputAndShowHidden);
});

