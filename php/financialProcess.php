<?php
require_once("init.php");

if (Input::exists()) {
  if (Token::check(Input::get("tokenNumber"))) {
    $data = [];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      array_pop($_POST);
      $fields = $_POST;
    } else {
      array_pop($_GET);
      $fields = $_GET;
    }
    $validate = new Validate();
    $validation = $validate->check($fields, [
      "firmId" => [
        "required" => true
      ],
      "financialYear" => [
        "required" => true
      ]
    ]);
    if ($validation->passed()) {
      $financial = DB::getInstance();
      if ($financial->insert("Financials", $fields)) {
        $data["sts"] = true;
        $data["msg"] = "Financial has been added successfully";
        echo json_encode($data);
      } else {
        $data["sts"] = false;
        $data["msg"] = "Error while adding financial";
        echo json_encode($data);
      }
    } else {
      $data["sts"] = false;
      $data["msg"] = $validation->errors();
      echo json_encode($data);
    }
  } else {
    header("location: ../financial.php");
  }
} else {
  header("location: ../financial.php");
}
