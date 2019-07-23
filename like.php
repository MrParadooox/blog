<?php 
require_once('DBconfig.php');

if ($_SERVER['REQUEST_METHOD']=="GET") {
    $IdRecord=$_GET["idRecord"];
    $userId=$_GET["userid"];
    $likes=$_GET["likes"];
    $conn=new mysqli(ServerName, UserName, Password, DBName);
    if ($conn->connect_error) {
    die ("Помилка з'єднання з БД".$conn->connect_error);
        }
    $sql = "SELECT * FROM `like` WHERE `PostId` = '{$IdRecord}' and `UserId` = '{$userId}'";
    $result=$conn->query($sql);
    echo $conn->error;
    if ($result->num_rows==1){
        $sql = "DELETE FROM `like` WHERE `PostId` = '{$IdRecord}' and `UserId` = '{$userId}'";
        $conn->query($sql);
    } else if ($result->num_rows ==0 && $likes == 1){
        $sql = "INSERT INTO `like`(`PostId`, `UserId`, `likes`, `Dislike`) VALUES ('{$IdRecord}', '{$userId}', 1 , 0)";
        $conn->query($sql);
        echo $conn->error;
    } else if ($likes == 0){
        $sql = "INSERT INTO `like`(`PostId`, `UserId`, `likes`, `Dislike`) VALUES ('{$IdRecord}', '{$userId}', 0 , 1)";
        $conn->query($sql);
        echo $conn->error;
    }
}
if ($_GET["to"] == "index"){
    header("Location: index.php");  
}else if ($_GET["to"] == "view"){
    header("Location: viewPost.php?idRecord=".$IdRecord);
}
