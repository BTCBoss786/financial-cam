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
      "firmName" => [
        "required" => true,
        "unique" => "Firms"
      ],
      "firmType" => [
        "required" => true
      ]
    ]);
    if ($validation->passed()) {
      $firm = DB::getInstance();
      if ($firm->insert("Firms", $fields)) {
        $data["sts"] = true;
        $data["msg"] = "Firm has been added successfully";
        echo json_encode($data);
      } else {
        $data["sts"] = false;
        $data["msg"] = "Error while adding firm";
        echo json_encode($data);
      }
    } else {
      $data["sts"] = false;
      $data["msg"] = $validation->errors();
      echo json_encode($data);
    }
  } else {
    header("location: ../index.php");
  }
} else {
  header("location: ../index.php");
}
