<?php

class User {
  private $name;
  private $lastname;
  private $email;
  private $id;

  function __construct($id, $name, $lastname, $email) {
    $this->id = $id;
    $this->name = $name;
    $this->lastname = $lastname;
    $this->email = $email;
  }

  function getId() {return $this->id;}
  function getName() {return $this->name;}
  function getLastname() {return $this->lastname;}
  function getEmail() {return $this->email;}

  // статический метод добавления(регистрации) пользователя
  static function addUser($name, $lastname, $email, $pass) {
    global $mysqli;
    $email = mb_strtolower(trim($email));
    $pass = trim($pass);
    $pass = password_hash($pass, PASSWORD_DEFAULT);

    $result = $mysqli->query("SELECT * FROM `users` WHERE `email`= '$email'");

    if ($result->num_rows != 0) {
      return json_encode(["result"=> "exist"]);
    } else {
      // ! Добавляем пользователя с указанными данными в БД посредством отправки sql запроса на сервер со значениями из переданных в функцию addUser во время вызова-вызов состоялся ??? !! пересмотри схему рисовал вторая часть лекции форма - эдд юсер - куда? - вызов в В классе Юзер пхп!.
      $mysqli->query("INSERT INTO `users`(`name`, `lastname`, `email`, `pass`) VALUES ('$name', '$lastname', '$email', '$pass')");
      // и верни/возвращает в по сути на страницу формы что все ок. (она потом направит пользователя на страницу логина через 3 секунды...)
      return json_encode(["result"=> "success"]);
    }
  }

  static function authUser($email, $pass) {
    global $mysqli;
      $email = mb_strtolower(trim($email));
      $pass = trim($pass);
      // return json_encode($email);
      // return json_encode($pass);
      $result = $mysqli->query("SELECT * FROM `users` WHERE `email`='$email'");
      // $result = $mysqli->query("SELECT * FROM `users` WHERE `email`='$email'");
      // $result = $mysqli->query("SELECT * FROM `users` WHERE `email`= '$email'");
      $result = $result->fetch_assoc();
      // return json_encode($result->num_rows);

      // password_verify($pass, $result["pass"])


      // return json_encode($result);
      if(password_verify($pass, $result["pass"])) {
        $_SESSION["id"] = $result["id"];
        $_SESSION["name"] = $result["name"];
        $_SESSION["lastname"] = $result["lastname"];
        $_SESSION["email"] = $result["email"];
        return json_encode(["result"=> "success"]);
      } else {
        return json_encode(["result"=> "exist"]);
      }


    // return "success";







    // if ($mysqli == false) {
    //   print("error");
    // } else {
    //   $email = mb_strtolower(trim($email));
    //   $pass = trim($pass);
    //   $result = $mysqli->query("SELECT * FROM `users` WHERE `email`='$email' AND `pass`='$pass'");
    //   $result = $result->fetch_assoc();

    //   if(password_verify($pass, $result["pass"])) {
    //     // echo "ok";
    //     // print(true);
    //     $_SESSION["id"] = $result["id"];
    //     $_SESSION["name"] = $result["name"];
    //     $_SESSION["lastname"] = $result["lastname"];
    //     $_SESSION["email"] = $result["email"];
    //     // echo
    //     return json_encode(["result"=> "success"]);
    //   } else {
    //     //   // $mysqli->query("INSERT INTO `mail-pass`(`email`, `pass`) VALUES ('$email', '$pass')");

    //     return json_encode(["result"=> "exist"]);

    //     // "user_not_found";
    //     // print(false);
    //   }


      // return "success";
    // }

  }
}
?>