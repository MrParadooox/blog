<?php
require_once("header.php");
require_once("DBconfig.php");
require_once("func.php");
echo $_SESSION["login"];
$conn=new mysqli(ServerName, UserName, Password, DBName);
if ($conn->connect_error) {
    die ("Помилка з'єднання з БД".$conn->connect_error);
} else {
  $sql = "SELECT * FROM `users` WHERE `login`='{$_SESSION["login"]}'";
    $result=$conn->query($sql);
    if ($result->num_rows==1){
      $row=$result->fetch_assoc();
     var_dump($row);
    }


};
$conn->close();

?>

<img src="<?='/4/img/ava/'.$row['urlAvatar']?>" width='300px' height='300px' class="rounded mx-auto d-block" alt="...">
<form class="w-50 mr-auto ml-auto p-5" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input class="form-control" name="login" type="email" placeholder="ppancor@yandex.ru" readonly>
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input name="Password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" value='<?=$row['Password']?>'>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">end Password</label>
    <input name="Password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" value='<?=$row['Password']?>'>
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">NickName</label>
    <input name="Nick" type="NickName" class="form-control" id="exampleInputPassword1" placeholder="NickName" value='<?=$row['Nick']?>'>
  </div>
  <div class="custom-file">
    <input name="urlAvatar" type="file" class="custom-file-input " id="validatedCustomFile" value="<?='/4/img/ava/'.$row['urlAvatar']?>">
    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
    <div class="invalid-feedback">Example invalid custom file feedback</div>
  </div>
  <br><br>
  <button type="submit" class="btn btn-primary w-100 mt-5">Submit</button>
</form>

<?php
// if ($_FILES["Avatar"][Name]!=''){
// if ($row["Avatar"]!='anonumys.phg'{){
//   //видаляєм стару
//   // добавляєм нову
//     }
//   else {
//   //записуєм нову
// }
// }
// }
?>

<?php
if ($_SERVER["REQUEST_METHOD"]="POST") {
    if ($_FILES["urlAvatar"]["Name"]=="" && $row['urlAvatar']!="anonymos.png"){

    };
}
require_once("footer.php");
?>