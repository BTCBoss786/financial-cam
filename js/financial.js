import {isValid, firmList, calc} from "./func.js";

$(document).ready(function(){
  var form = $("#financialForm");
  var firmId = $("#firmId");
  var financialYear = $("#financialYear");
  
  firmList();
  calc();

  form.unbind("submit").bind("submit", function(){
    if (isValid(firmId) && isValid(financialYear)) {
      $.ajax({
        url: "php/financialProcess.php",
        method: "post",
        data: form.serialize(),
        dataType: "json"
      }).done(function(rsp){
        if (rsp.sts == true) {
          form.append('<p class="text-center text-success">'+rsp.msg+'</p>');
        } else {
          form.append('<p class="text-center text-danger">'+rsp.msg+'</p>');
        }
        setTimeout(function(){
          window.location.assign("./financial.php");
        }, 2000);
      });
    }
    return false;
  });

});
