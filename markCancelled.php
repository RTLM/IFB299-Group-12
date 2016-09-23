<?php
include "database.php";
if(isset($_POST["statusCancel"])){
    $db = new database;
    $db->connectToDatabase();
    $orderNumber = htmlspecialchars($_POST["statusCancel"]);
    $sql = "UPDATE `orders` SET `status`='Cancelled' WHERE `orderNo`='$orderNumber';";
    if($db->runASqlQuery($sql)){
        header("Location:history.php");
    }
    else{
        header("Location:error.php");
    }
}
