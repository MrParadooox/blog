<?php
require_once("header.php");
require_once("DBconfig.php");
require_once("func.php");
?>


<form class="w-50 mr-auto ml-auto p-5" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input name="login" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input name="Password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary w-100 mt-5">Submit</button>
</form>



<?php

if ($_SERVER ["REQUEST_METHOD"] =="POST"){
    $conn=new mysqli(ServerName, UserName, Password, DBName);
    if ($conn->connect_error) {
        die ("Помилка з'єднання з БД".$conn->connect_error);
    } else {       
        $Password=PasswordHasher($_POST['Password']);
        $login = $_POST['login'];
        echo $Password.'   '.$login;
        $sql = "SELECT `login`, `Password` FROM `users` WHERE `login`='{$login}' and `Password`='{$Password}'";
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();
        echo "<br>".$result->num_rows."<br>";
        var_dump($row);
        if ($result->num_rows==1){
          Autorization($login);
          header('Location:index.php');
        
            } else {
                echo "все погано";
            }
        
    };
    $conn->close();
    // header("Location: ".$_SERVER['REQUEST_URI']);
}
?>

<?php
require_once("footer.php");
?>