<?php
require_once("init.php");

$data = [];
if (Input::exists()) {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fields = $_POST;
  } else {
    $fields = $_GET;
  }
  $validate = new Validate();
  $validation = $validate->check($fields, [
    "firmId" => [
      "required" => true
    ]
  ]);
  if ($validation->passed()) {
    $financial = DB::getInstance();
    if (!empty($fields["financialYear"])) {
      $financialYear = "";
      $i = 1;
      foreach ($fields["financialYear"] as $field) {
        $financialYear .= "`Financial Year` = ?";
        if ($i < count($fields["financialYear"])) {
          $financialYear .= " OR ";
        }
        $i++;
      }
      if ($financial->query('SELECT * FROM `financialData` WHERE `Firm ID` = '.$fields["firmId"].' AND ('.$financialYear.') ORDER BY `Financial Year` DESC', $fields["financialYear"])) {
        $data["sts"] = true;
        $data["msg"] = $financial->results();
        echo json_encode($data);
      }
    } else {
      if ($financial->query('SELECT * FROM `financialData` WHERE `Firm ID` = '.$fields["firmId"].' ORDER BY `Financial Year` DESC')) {
        $data["sts"] = true;
        $data["msg"] = $financial->results();
        echo json_encode($data);
      }
    }
  } else {
    $data["sts"] = false;
    $data["msg"] = $validation->errors();
    echo json_encode($data);
  }
}
