<?php
include "database.php";
if(isset($_POST["status"])){
    $db = new database;
    $db->connectToDatabase();
    $status = htmlspecialchars($_POST["status"]);
    echo "<script>console.log('$status')</script>";
    $orderNumber = htmlspecialchars($_POST["orderNumber"]);
    $sql = "UPDATE `orders` SET `status`='$status' WHERE `orderNo`='$orderNumber';";
    if($db->runASqlQuery($sql)){
        header("Location:delivery.php");
    }
    else{
        header("Location:error.php");
    }
}
