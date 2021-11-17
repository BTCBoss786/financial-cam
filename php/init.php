<?php
session_start();

$GLOBALS["config"] = [
  "mysql" => [
    "host" => "localhost",
    "user" => "root",
    "pass" => "",
    "db" => "lk_cam"
  ],
  "cookie" => [
    "name" => "hash",
    "expiry" => "604800"
  ],
  "session" => [
    "name" => "user",
    "token" => "token"
  ]
];

require_once(__DIR__."/sanitize.php");

spl_autoload_register(function($class){
  require_once(__DIR__."/class/".$class.".php");
});
