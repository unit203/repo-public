<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
// var_dump($url);


if($url[1] == "blog") {
  require("blog.php");
} else if($url[1] == "register") {
  require("register.html");
}


// for($i = 0; $i < count($url); $i++) {
//   echo $url[$i] . "<hr>";
// }
