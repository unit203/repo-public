<?php

class Person {
  private $name;
  private $lastname;
  private $age;
  private $hp;
  private $mother;
  private $father;

  function __construct($name, $lastname, $age, $mother=null, $father=null) {
    $this->name = $name;
    $this->lastname = $lastname;
    $this->age = $age;
    $this->hp = 100;
    $this->mother = $mother;
    $this->father = $father;
  }

  function getName() {
    return $this->name;
  }

  function getLastname() {
    return $this->lastname;
  }

  function getMother() {
    // return $this->mother;
    if ($this->mother == true) {
      return $this->mother;
    } else if ($this->mother == null) {
      // $dead;
      echo "Сработало12344567899232141234567";
      // $this->mother = null;
      // return $this->mother;
    }

  }

  function getFather() {
    return $this->father;
  }

  function setHp($hp) {
    if($this->hp + $hp >= 100) {$this->hp = 100;
    } else {$this->hp = $this->hp + $hp;}
    $this->hp = $this->hp + $hp;
  }

  function getHp() {
    return $this->hp;
  }

  function sayHi($name) {
    return "Hi, $name, I`m " . $this->name;
  }

  function getInfo() {
    echo " <h1> Инфо:</h1><hr>" . "Имя: " . $this->getName() . "<br>" . "Фамилия: " . $this->getLastname();
    echo " <h2>Родители:</h2><br>";
    echo " <h3>Отец:</h3>";
    echo " Имя: " . $this->getFather()->getName() . "<br>" . "Фамилия: " . $this->getFather()->getLastname();

    echo " <h3> Мать:</h3>";
    echo " Имя: " . $this->getMother()->getName() . "<br>" . "Фамилия: " . $this->getMother()->getLastname();

    echo " <h2>Родители Мaтери:</h2><br>";
    echo " <h3>Отец:</h3>";
    echo " Имя: " . $this->getMother()->getFather()->getName() . "<br>" . "Фамилия: " . $this->getMother()->getFather()->getLastname();

    echo " <h3> Мать:</h3>";
    echo " Имя: " . $this->getMother()->getMother()->getName() . "<br>" . "Фамилия: " . $this->getMother()->getMother()->getLastname();

    echo " <h2>Родители Отца:</h2><br>";
    echo " <h3>Отец:</h3>";
    echo " Имя: " . $this->getFather()->getFather()->getName() . "<br>" . "Фамилия: " . $this->getFather()->getFather()->getLastname();

    echo " <h3> Мать:</h3>";
    echo " Имя: " . $this->getFather()->getMother()->getName() . "<br>" . "Фамилия: " . $this->getFather()->getMother()->getLastname();
  }
}




// дед 1
$igor = new Person("Igor", "Ivanov", 68, null, null);
// бабка 1
$anastasia = new Person("Anastasia", "Ivanova", 60, null, null);
// !? нет
// дед 2
$ivan = new Person("Ivan", "Serov", 68, null, null);
// бабка 2
$vera = new Person("Vera", "Serova", 60, null, null);

// отец 1
$alex = new Person("Alex", "Ivanov", 42, $anastasia, $igor);
// мать 2
$olga = new Person("Olga", "Ivanova", 38, $vera, $ivan);
// отпрыск
$valera = new Person("Valera", "Ivanov", 15, $olga, $alex);

$medKit = 50;

// $alex->setHp(-30); //Упал. (70)
// echo $alex->getHp() . "<br>";
// $alex->setHp($medKit); //Упал. (70)
// echo $alex->getHp() . "<br>";



echo $valera->getInfo();
