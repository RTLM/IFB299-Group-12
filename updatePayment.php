<?php
include "database.php";
if(isset($_POST["orderNo"])){
    $db = new database;
    $db->connectToDatabase();
    $orderNumber = htmlspecialchars($_POST["orderNo"]);
	$paymentType = $_POST["paymentType"];
    $sql = "UPDATE `orders` SET `paid`='TRUE', paymentType = '$paymentType' WHERE `orderNo`='$orderNumber';";
    if($db->runASqlQuery($sql)){
        header("Location:assigned.php");
    }
    else{
        header("Location:error.php");
    }
}
?>