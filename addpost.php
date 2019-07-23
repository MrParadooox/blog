<?php
require_once("header.php");
require_once("DBconfig.php");
?>

<form class="w-50 mr-auto ml-auto p-5" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleFormControlInput1">Заголовок</label>
    <input class="form-control form-control-lg" name="headline" type="text" placeholder="введите заголовок">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Выберете категорию</label>
    <select name="category" class="form-control" id="exampleFormControlSelect1">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Пост</label>
    <textarea class="form-control" name="caption" id="exampleFormControlTextarea1" rows="15"></textarea>
  </div>

  <div class="form-group border p-3">
    <label for="exampleFormControlFile1">Example file input</label>
    <input type="file" name="path" class="form-control-file" id="exampleFormControlFile1">
  </div>
  <button type="submit" class="btn btn-primary w-100 mt-5">Submit</button>
</form>


<?php
if ($_SERVER ["REQUEST_METHOD"] =="POST"){
  var_dump($_POST);
  // var_dump($_FILES);

  if ($_POST['headline'] == ''){
    die ("Заполните заголовок");
  } else if($_POST['caption'] == ""){
   die ("Заполните описание");
  } else if ($_FILES["path"]["name"] == ""){
   die ("добавьте картинку");
  } else {
    $expansion=explode('.', $_FILES["path"]["name"]);
    // var_dump($_FILES);
    // var_dump($expansion);
    $FileName=md5(microtime()).".".$expansion[count($expansion)-1]; 
    move_uploaded_file($_FILES["path"]["tmp_name"],"img/".$FileName);
  }
  $conn=new mysqli(ServerName, UserName, Password, DBName);
  if ($conn->connect_error) {
    die ("Помилка з'єднання з БД".$conn->connect_error);
  }
    $sql = "INSERT INTO `posts`(`headline`, `category`, `caption`, `path`) VALUES ('{$_POST['headline']}', '{$_POST['category']}', '{$_POST['caption']}', '{$FileName}')";
    $result=$conn->query($sql);
    echo $conn->error;
    var_dump($result);
  $conn->close();
  }
?>


<?php
require_once("footer.php");
?>



