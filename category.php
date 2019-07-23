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
$conn=new mysqli(ServerName, UserName, Password, DBName);
if ($conn->connect_error) {
  die ("Помилка з'єднання з БД".$conn->connect_error);
}
$sql = "SELECT * FROM `category`";
$result=$conn->query($sql);  
echo $conn->error;
while ($row=$result->fetch_assoc()){
    ?>

    
<li class="list-group-item"><a href="category.php?idcategory=<?=$row['id']?>"><?=$row['Name']?></a></li>
                <?php
                    }
                    ?>
            </ul>
        </div>

        <!-- <?php
            $sql = "SELECT * FROM `categorys`";
            $result=$conn->query($sql);  
            echo $conn->error;
            while ($row=$result->fetch_assoc()){

            }
        ?> -->
<?php
$sql = "SELECT * FROM `category`";
$result=$conn->query($sql);  
echo $conn->error;
$i=0;
while ($row=$result->fetch_assoc()){
    $i++
    ?>

        <div class="col">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src=".../100px180/" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <?php if ($i == 2){ ?>
            <div class="col-3"></div>
            <?=$i=0?>
        <?php
        } 
        }
        ?>
    </div>
</div>





























<?php
require_once("footer.php");
?>