<?php
require_once("init.php");

$data = [];
if (Input::exists()) {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fields = $_POST;
  } else {
    $fields = $_GET;
  }
  $financial = DB::getInstance();
  if (!empty($fields["financialId"])) {
    $financialId = "";
    $i = 1;
    foreach ($fields["financialId"] as $field) {
      $financialId .= "`Financial ID` = ?";
      if ($i < count($fields["financialId"])) {
        $financialId .= " OR ";
      }
      $i++;
    }
    if ($financial->query('SELECT * FROM `balanceSheet` WHERE ('.$financialId.') ORDER BY `Financial Year` DESC', $fields["financialId"])) {
      $data["sts"] = true;
      $data["msg"] = $financial->results();
      echo json_encode($data);
    }
  } else {
    $data["sts"] = false;
    $data["msg"] = "No Financial Exists";
    echo json_encode($data);
  }
}
