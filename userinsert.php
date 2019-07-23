<?php
require_once("header.php");
require_once("DBconfig.php");
require_once("func.php");

// $conn=new mysqli(ServerName, UserName, Password, DBName);
// if ($conn->connect_error) {
//     die ("Помилка з'єднання з БД".$conn->connect_error);
// } else {
//     echo "З'эднання з БД успішне";
// };

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
  <div class="form-group">
    <label for="exampleInputPassword1">NickName</label>
    <input name="Nick" type="NickName" class="form-control" id="exampleInputPassword1" placeholder="NickName">
  </div>
  <div class="custom-file">
    <input name="urlAvatar" type="file" class="custom-file-input " id="validatedCustomFile" required>
    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
    <div class="invalid-feedback">Example invalid custom file feedback</div>
  </div>
  <br><br>
  <button type="submit" class="btn btn-primary w-100 mt-5">Submit</button>
</form>



<?php

if ($_SERVER ["REQUEST_METHOD"] =="POST"){
  if ($_POST['login'] == ''){
    die ("Заполните логин");
  } else if($_POST['Password'] == ""){
   die ("Заполните пароль");
  } else if ($_POST['Nick'] == ""){
   die ("заполните ник");
  }
  $conn=new mysqli(ServerName, UserName, Password, DBName);
    if ($conn->connect_error) {
        die ("Помилка з'єднання з БД".$conn->connect_error);
    } else {
        if($_FILES["urlAvatar"]["name"]){
            $expansion=explode('.', $_FILES["urlAvatar"]["name"]);
            var_dump($_FILES);
            var_dump($expansion);
            $FileName=md5(microtime()).".".$expansion[count($expansion)-1]; 
            move_uploaded_file($_FILES["urlAvatar"]["tmp_name"],"img/".$FileName);
        }
        $Password=PasswordHasher($_POST['Password']);
        $login = $_POST['login'];
        $Nick = $_POST['Nick'];
        $sql = "SELECT * FROM `users` WHERE `login`='{$login}'";
        $result=$conn->query($sql);
        if ($result->num_rows<1){
            // $sql = "INSERT INTO `users` (`login`,`Password`,`Nick`,`urlAvatar`) VALUES ('{$_POST['login']}','{$Password}','{$_POST['Nick']}','{$FileName}')";
           $stmt=$conn->prepare("INSERT INTO `users` (`login`,`Password`,`Nick`,`urlAvatar`) VALUES (?,?,?,?)");
           $stmt->bind_param("ssss", $login, $Password, $Nick, $FileName);
           $login = trim(htmlspecialchars($login));
           $Nick = trim(htmlspecialchars($Nick));
           $Password = trim(htmlspecialchars($Password));
           $FileName = trim(htmlspecialchars($FileName));
           if ($stmt->execute()){
                Autorization($login);
                header("Location: index.php");
            } else {
                echo "данні не збереженно".$conn->error;
            }
        } else {
            $row=$result->fetch_assoc();
            echo "{$row['login']} пользователь с таким емайлом уже зарегистрирован";
        }
        
    };
    $conn->close();
    // header("Location: ".$_SERVER['REQUEST_URI']);
}




// var_dump($_POST);
// $result = false;
// if (isset($_POST["login"])) {
//     $result = mysqli_query($conn, "INSERT INTO `users` (`login`,`Password`,`Nick`) VALUES ('{$_POST['login']}','{$_POST['Password']}','{$_POST['Nick']}')");
// };

// if ($result == true){
//     header("Location: ".$_SERVER['REQUEST_URI']);
// 	echo "Информация занесена в базу данных";
// }else{
// 	echo "Информация не занесена в базу данных";
// }

?>

<?php
require_once("footer.php");
?>