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
      $mysqli->query("INSERT INTO `users`(`name`, `lastname`, `email`, `pass`) VALUES ('$name', '$lastname', '$email', '$pass')");
      // и верни/возвращает в по сути на страницу формы что все ок. (она потом направит пользователя на страницу логина через 3 секунды...)
      return json_encode(["result"=> "success"]);
    }
  }

  static function authUser($email, $pass) {
    global $mysqli;
      $email = mb_strtolower(trim($email));
      $pass = trim($pass);
      $result = $mysqli->query("SELECT * FROM `users` WHERE `email`='$email'");
      $result = $result->fetch_assoc();

      if(password_verify($pass, $result["pass"])) {
        $_SESSION["id"] = $result["id"];
        // $_SESSION["name"] = $result["name"];
        // $_SESSION["lastname"] = $result["lastname"];
        // $_SESSION["email"] = $result["email"];
        return json_encode(["result"=> "success"]);
      } else {
        return json_encode(["result"=> "exist"]);
      }
  }

  // Статический метод получения данных одного пользователя
  static function getUser($userId) {
    global $mysqli;
    // Получаю от сервера конкретные данные из имеющихся на сервере.
    $result = $mysqli->query("SELECT `name`, `lastname`, `email`, `id` FROM `users` WHERE `id`='$userId'");
    $result = $result->fetch_assoc();
    return json_encode($result);
  }
// Статический метод получения всех пользователей
  static function getUsers() {
    global $mysqli;
// Запрос в БД на получение всех пользователей с указанными полями из ВСЕГО перечня.
$result = $mysqli->query("SELECT `name`, `lastname`, `email`, `id` FROM `users` WHERE 1");
// Цикл, переменная ПХП будет равна не пустому содержанию элемента(Который  был получен посредством метода фетч ассок дающего массив объектов. Далее этот массив будет перебираться циклом и когда не останется объектов в массиве он "вернет" результат false и это будет являться условием НЕ ИСТИННОСТИ цикла что его ОСТАНОВИТ. )
    while($row = $result->fetch_assoc()) {
      // На каждой итерации, в ПХП, без методов записи как в js можно записывать значение в массив. Что и будет происходить - объекты будут "наполнять" массив с каждой итерацией пока не кончатся в нем.
      $users[] = $row;
    }
    // После завершения цикла  вернет содержимое массива в запрошенном месте. (На странице.)
    return json_encode($users);
  }
}
?>