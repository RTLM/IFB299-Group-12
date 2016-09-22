<?php
include "database.php";
if(isset($_POST["statusComplete"])){
    $db = new database;
    $db->connectToDatabase();
    $orderNumber = htmlspecialchars($_POST["statusComplete"]);
    $sql = "UPDATE `orders` SET `status`='complete' WHERE `orderNo`='$orderNumber';";
    if($db->runASqlQuery($sql)){
        header("Location:delivery.php");
    }
    else{
        header("Location:error.php");
    }
}
