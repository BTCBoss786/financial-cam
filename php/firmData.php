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
    $firm = DB::getInstance();
    if ($firm->get("firmData", ["`Firm ID`", "=", $fields["firmId"]])) {
      $data["sts"] = true;
      $data["msg"] = $firm->results();
      echo json_encode($data);
    } else {
      $data["sts"] = false;
      $data["msg"] = "No Firm Exists";
      echo json_encode($data);
    }
  }
} else {
  $firm = DB::getInstance();
  if ($firm->query("SELECT * FROM `firmData`")) {
    $data["sts"] = true;
    $data["msg"] = $firm->results();
    echo json_encode($data);
  }
}
