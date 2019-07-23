<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a196126947.js"></script>
    <title>Document</title>
</head>
<body>
<?php
require_once("DBconfig.php");
session_start();
if (isset($_SESSION["Autorizzation"]) && $_SESSION["Autorizzation"]==TRUE){
$conn=new mysqli(ServerName, UserName, Password, DBName);
$sql = "SELECT `Role` FROM `users` WHERE `login`='{$_SESSION["login"]}'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$role=$row['Role'];
$conn->close();
} else {
  $role='guest';
}
?>





<nav class="navbar navbar-expand-lg navbar-light bg-light">

  <a class="navbar-brand" href="index.php">Головна</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
<?php
 
if ($role == 'Admin' || $role == 'Autor') {

?>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Мої записи
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Додати запис</a>
          <a class="dropdown-item" href="#">Редактувати записи</a>
        </div>
<?php
};

if ($role == 'Admin'){
?>
      </li>
      <li style="list-style-type: none" class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Панель Адміністратора
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Користувачі</a>
          <a class="dropdown-item" href="#">Записи</a>
          <a class="dropdown-item" href="#">Коментарі</a>
        </div>
      </li>
      <?php
}
?>
    </ul>
  </div>
<?php
if (isset($_SESSION["Autorizzation"]) && $_SESSION["Autorizzation"]==TRUE){
  ?>
<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?=$_SESSION["login"]?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="edit.php">Редактувати</a>
          <a class="dropdown-item" href="outLog.php">вихід</a>
        </div>
      </li>

<?php 
} else {
  ?>
  <a class="nav-link" href="login.php">Увійти</a>
  <a class="nav-link" href="userinsert.php">зарегіструватись</a>
<?php
}
?>
  </nav>