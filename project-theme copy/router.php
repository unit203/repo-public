<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
// $content = file_get_contents("pages/index.php");
require_once("php/classes/User.php");
require_once("php/db.php");

// 
// 
// 
// Если запрашивается пользователем страница в урле с именем blog то будем записывать в переменную страницу для отрисовки такую то и позже передавать ее ва отрисовку.

if($url[1] == "blog") {
  $content = file_get_contents("pages/blog.php");
} else if($url[1] == "register") {
  $content = file_get_contents("pages/register.html");
} else if($url[1] == "auth") {
  $content = file_get_contents("pages/login.html");
} else if($url[1] == "tracking") {
  $content = file_get_contents("pages/tracking-order.html");
} else if($url[1] == "contact") {
  $content = file_get_contents("pages/contact.html");
} else if($url[1] == "users") {
  require_once("pages/users/index.html");
} else if($url[1] == "addUser") {
  echo User::addUser($_POST["name"], $_POST["lastname"], $_POST["email"], $_POST["pass"]);
} else {
  $content = file_get_contents("pages/index.php");
}


if (!empty($content))
require_once("template.php");
