<?php
require_once("header.php");
?>

<div class="container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb  mt-5 mb-4">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      </ol>
  </nav>
  <div class="row">
    <div class="col-3">
      <ul class="list-group">
        <li class="list-group-item d-flex justify-content-center">
         <b>Категории  </b>
        </li>
<?php 
$conn=new mysqli(ServerName, UserName, Password, DBName);
if ($conn->connect_error) {
  die ("Помилка з'єднання з БД".$conn->connect_error);
}
$sql = "SELECT * FROM `category`";
$result=$conn->query($sql);  
echo $conn->error;
while ($row=$result->fetch_assoc()){
?>
        <li class="list-group-item"><a href="index.php?idcategory=<?=$row['id']?>"><?=$row['Name']?></a></li>
<?php } ?>

      </ul>
    </div>


    <?php

if ($_SERVER['REQUEST_METHOD']=="GET") {
  if (isset($_GET["idcategory"])) {
    $idcategory = $_GET["idcategory"];
    $sql = "SELECT * FROM `newv` WHERE `category` =  {$idcategory} ";
   
  } else {
  $sql = "SELECT * FROM `postindex` LIMIT 20";
  }
    $result=$conn->query($sql);
    echo $conn->error;
    while ($row=$result->fetch_assoc()){
      if ($row["Like"]==NULL) $row["Like"]=0;
      if ($row["DisLike"]==NULL) $row["DisLike"]=0;
        ?>

    <div class="col-8">
      <div class="card mb-3" style="max-width: 100%;">
        <div class="row no-gutters">
          <div class="col-md-4">
            <img src="<?='/4/img/'.$row['path']?>" class="card-img" alt="..." style="mardin-top: auto;">
            <center><label for="card-body"><?=$row['Nick']?></label><br>
              <p class="card-text"><small class="text-muted">Дата публикации: <?=$row['datetime']?></small></p>
              <label for="card-body">Опублікувати/удалити</label>
            </center>
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title"><?=$row['headline']?></h5>
              <p class="card-text"><?=substr($row['caption'], 0 , 500)."..."?></p>

              <button type="button" class="btn  btn-warning"
                                href="like.php?idRecord=<?=$row['id']?>&userid=10">
                                <i class="far fa-comments"></i> <span
                                    class="badge badge-light"><?=$row['Comment']?></span>
                                <span class="sr-only">unread messages</span>
                            </button>
                            <button onclick="window.location.href='like.php?idRecord=<?=$row['id']?>&userid=10&likes=1&to=index'" type="button" class="btn btn-success">
                                <i class="fas fa-thumbs-up"></i> <span
                                    class="badge badge-light"><?=$row['Like']?></span>
                                <span class="sr-only">unread messages</span>
                            </button>
                            <button onclick="window.location.href='like.php?idRecord=<?=$row['id']?>&userid=10&likes=0&to=index'" type="button" class="btn btn-primary">
                                <i class="fas fa-thumbs-down"></i> <span class="badge badge-light"><?=$row['DisLike']?>
                                </span>
                                <span class="sr-only">unread messages</span>
                            </button>


              <form method="post">
                <a type="submit" name="test" id="test" class="btn btn-primary float-right"
                  href="viewPost.php?idRecord=<?=$row['id']?>">Primary</a><br>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-3"> </div>
    <?php
}
}
  $conn->close();

  ?>


  </div>
</div>

<?php
  require_once("footer.php");
?>