import {isValid, firmList, toInr, calc} from "./func.js";

$(document).ready(function(){
  firmList();

  $("#firmId").unbind("change").bind("change", function(){
    $("#financialYear").empty();
    $("#firmDetails").empty();
    $("#financialDetails").empty();
    $.ajax({
      url: "php/financialData.php",
      method: "post",
      data: $("#reportForm").serialize(),
      dataType: "json"
    }).done(function(rsp){
      if (rsp.sts == true) {
        $.each(rsp.msg, function(i, v){
          $("#financialYear").append(
            '<div class="custom-control custom-checkbox col-auto">'+
            '<input type="checkbox" class="custom-control-input" id="'+v["Financial Year"]+'" name="financialYear[]" value="'+v["Financial Year"]+'" checked>'+
            '<label class="custom-control-label mr-5" for="'+v["Financial Year"]+'">'+v["Financial Year"]+'</label>'+
            '</div>'
          );
        });
      }
    });
  });

  $("#reportForm").unbind("submit").bind("submit", function(){
    var validYear = 0;
    var financialId = [];
    $("#firmDetails").empty();
    $("#financialDetails").empty();
    $("#financialYear").find("input").each(function(i, v){
      if (isValid($(this)))
      validYear = 1;
    });

    $.ajax({
      url: "php/firmData.php",
      method: "post",
      data: $("#reportForm").serialize(),
      dataType: "json"
    }).done(function(rsp){
      if (rsp.sts == true) {
        $.each(rsp.msg, function(i, v){
          $("#firmDetails").append(
            '<tr>'+
            '<th scope="row" class="w-25">Firm Name</th>'+
            '<td>'+v["Firm Name"]+'</td>'+
            '</tr>'+
            '<tr>'+
            '<th scope="row" class="w-25">Firm Type</th>'+
            '<td>'+v["Firm Type"]+'</td>'+
            '</tr>'
          );
        });

        if (validYear) {
          $.ajax({
            url: "php/financialData.php",
            method: "post",
            async: false,
            data: $("#reportForm").serialize(),
            dataType: "json"
          }).done(function(rsp){
            if (rsp.sts == true) {
              var data = "";
              var msgKeys = Object.keys(rsp.msg[0]) ?? "";
              $("#financialYear").find("input").each(function(i, v){
                $(this).removeClass("is-invalid");
              });
              for (var i = 0; i < msgKeys.length; i++) {
                data += '<tr>';
                data += '<th scope="row" class="w-25">'+msgKeys[i]+'</th>';
                for (var j = 0; j < rsp.msg.length; j++) {
                  if (msgKeys[i] == "Financial ID")
                  financialId.push(rsp.msg[j][msgKeys[i]]);
                  data += '<td>'+rsp.msg[j][msgKeys[i]]+'</td>';
                }
                data += '</tr>';
              }
              $("#financialDetails").append(data);

              $.ajax({
                url: "php/financialPL.php",
                method: "post",
                async: false,
                data: {"financialId": financialId},
                dataType: "json"
              }).done(function(rsp){
                var data = "";
                var msgKeys = Object.keys(rsp.msg[0]) ?? "";
                for (var i = 0; i < msgKeys.length; i++) {
                  data += '<tr>';
                  data += '<th scope="row" class="w-25">'+msgKeys[i]+'</th>';
                  for (var j = 0; j < rsp.msg.length; j++)
                  data += '<td>'+rsp.msg[j][msgKeys[i]]+'</td>';
                  data += '</tr>';
                }
                $("#financialDetails").append(data);
              });

              $.ajax({
                url: "php/financialBS.php",
                method: "post",
                async: false,
                data: {"financialId": financialId},
                dataType: "json"
              }).done(function(rsp){
                var data = "";
                var msgKeys = Object.keys(rsp.msg[0]) ?? "";
                for (var i = 0; i < msgKeys.length; i++) {
                  data += '<tr>';
                  data += '<th scope="row" class="w-25">'+msgKeys[i]+'</th>';
                  for (var j = 0; j < rsp.msg.length; j++)
                  data += '<td>'+rsp.msg[j][msgKeys[i]]+'</td>';
                  data += '</tr>';
                }
                $("#financialDetails").append(data);
              });

              $.ajax({
                url: "php/financialRatio.php",
                method: "post",
                async: false,
                data: {"financialId": financialId},
                dataType: "json"
              }).done(function(rsp){
                var data = "";
                var msgKeys = Object.keys(rsp.msg[0]) ?? "";
                for (var i = 0; i < msgKeys.length; i++) {
                  data += '<tr>';
                  data += '<th scope="row" class="w-25">'+msgKeys[i]+'</th>';
                  for (var j = 0; j < rsp.msg.length; j++)
                  data += '<td>'+rsp.msg[j][msgKeys[i]]+'</td>';
                  data += '</tr>';
                }
                $("#financialDetails").append(data);
              });

              $("#exportExcel").remove();
              $("#tableData").prepend('<a href="#" class="float-right mb-3" id="exportExcel">Export to Excel</a>');
              $("#exportExcel").unbind("click").bind("click", function(){
                $("#financialDetails").toExcel();
              });

            }
          });
        }
      }
    });

    return false;
  });

});



// Direct Expenses
// Interest Paid
// Short Term Debt (CC/ OD facility which gets renewed year on year)
// Long Term Debt (Term loans for more than one year repayment incl secured & unsecured loans from banks & FI)
// Sundry Creditors
// Other Liability
// Sundry Debtors (< 6 months)
// Inventories / Closing Stock
