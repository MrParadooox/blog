<?php
require_once("header.php");
?>
<div class="container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb  mt-5 mb-4">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data</li>
        </ol>
    </nav>
<div class="row">
        <div class="col-3">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-center">
                <b>Категории</b>
                </li>    
<?php
if ($_SERVER['REQUEST_METHOD']="GET" && isset($_GET["idRecord"]) ) {
    $IdRecord=$_GET["idRecord"];
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


<?php
$sql = " SELECT * FROM `postindex` WHERE `id` = {$IdRecord}";
$result=$conn->query($sql);
echo $conn->error;
$row=$result->fetch_assoc();
// var_dump($row);
if ($row["Like"]==NULL) $row["Like"]=0;
if ($row["DisLike"]==NULL) $row["DisLike"]=0;
} else {
header('Location:index.php');
}
?>

        </div>
        <div class="col-8">
            <div class="card mb-3" style="max-width: 100%;">
                <div class="row no-gutters">
                    <div class="col-md-4">

                        <img src="<?='/4/img/'.$row['path']?>" class="card-img" alt="..." style="mardin-top: auto;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?=$row['headline']?></h5>
                            <p class="card-text"><?=substr($row['caption'], 0 , 500)."..."?></p>

                            <button type="button" class="btn  btn-warning"
                                href="like.php?idRecord=<?=$IdRecord?>&userid=10">
                                <i class="far fa-comments"></i> <span
                                    class="badge badge-light"><?=$row['Comment']?></span>
                                <span class="sr-only">unread messages</span>
                            </button>
                            <button onclick="window.location.href='like.php?idRecord=<?=$IdRecord?>&userid=10&likes=1&to=view'"
                                type="button" class="btn btn-success">
                                <i class="fas fa-thumbs-up"></i> <span
                                    class="badge badge-light"><?=$row['Like']?></span>
                                <span class="sr-only">unread messages</span>
                            </button>
                            <button onclick="window.location.href='like.php?idRecord=<?=$IdRecord?>&userid=10&likes=0&to=view'"
                                type="button" class="btn btn-primary">
                                <i class="fas fa-thumbs-down"></i> <span class="badge badge-light"><?=$row['DisLike']?>
                                </span>
                                <span class="sr-only">unread messages</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
































<?php
require_once("footer.php");
?>