export function isValid(obj) {
  var isValid;
  obj.removeClass("is-invalid");
  obj.prop("tagName", function(i, v){
    if (v == "INPUT") {
      if ($(this).prop("type") == "text") {
        isValid = ($(this).val() != "") ? true : false;
      } else if ($(this).prop("type") == "checkbox" || $(this).prop("type") == "radio") {
        isValid = ($(this).prop("checked")) ? true : false;
      }
    } else if (v == "SELECT") {
      isValid = ($(this).val() != "") ? true : false;
    }
  });
  if (!isValid) {
    obj.addClass("is-invalid");
  }
  return isValid;
}


export function firmList() {
  $.ajax({
    url: "php/firmData.php",
    dataType: "json"
  }).done(function(rsp){
    if (rsp.sts == true) {
      $.each(rsp.msg, function(i, v){
        firmId.append(new Option(v["Firm Name"], v["Firm ID"]));
      });
    }
  });
}


export function calc() {
  $("input").unbind("blur").bind("blur", function(){
    if ($(this).prop("type") != "date") {
      var val = $(this).val();
      if (!val.match(/([A-Z])/gi)) {
        $(this).val(eval(val));
      } else {
        $(this).val(val);
      }
    }
  });
}


// export function toTitleCase(str) {
//   if (typeof str == "string") {
//     var str = str.replace(/([A-Z])/g, " $1" );
//     str = str.charAt(0).toUpperCase() + str.slice(1);
//     return str;
//   }
//   return str;
// }


export function toInr(int) {
  if ($.isNumeric(int)) {
    var formatter = new Intl.NumberFormat('en-IN', {
      style: 'currency',
      currency: 'INR',
      minimumFractionDigits: 2
    });
    return (formatter.format(int));
  }
  return int;
}


export var toExcel = ($.fn.toExcel = function(fileName = ''){
  var tableHTML = this[0].outerHTML;
  var fileName = fileName ? fileName : $.now();
  var blob = new Blob([tableHTML], {type: "application/vnd.ms-excel"});
  var link = document.createElement('a');
  link.download = fileName;
  link.href = URL.createObjectURL(blob);
  link.click();
  URL.revokeObjectURL(link.href);
})
