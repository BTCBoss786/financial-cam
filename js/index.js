import {isValid} from "./func.js";

$(document).ready(function(){
  var form = $("#firmForm");
  var firmName = $("#firmName");
  var firmType = $("#firmType");
  var formAgree = $("#formAgree");

  form.unbind("submit").bind("submit", function(){
    if (isValid(firmName) && isValid(firmType) && isValid(formAgree)) {
      $.ajax({
        url: "php/firmProcess.php",
        method: "post",
        data: form.serialize(),
        dataType: "json"
      }).done(function(rsp){
        if (rsp.sts == true) {
          form.append('<p class="text-center text-success">'+rsp.msg+'</p>');
          setTimeout(function(){
            window.location.assign("./financial.php");
          }, 2000);
        } else {
          form.append('<p class="text-center text-danger">'+rsp.msg+'</p>');
          setTimeout(function(){
            window.location.assign("./index.php");
          }, 2000);
        }
      });
    }
    return false;
  });

});
