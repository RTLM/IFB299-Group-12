<?php
include "database.php";
if(isset($_POST["orderNo"])){
    $db = new database;
    $db->connectToDatabase();
    $orderNumber = htmlspecialchars($_POST["orderNo"]);
	if(isset($_POST['receiver'])) {
		$receiver = $_POST['receiver'];
		$sql = "UPDATE `orders` SET `status`='Complete', receiver='$receiver', dateComplete = NOW() + INTERVAL 10 HOUR WHERE `orderNo`='$orderNumber';";
	} else {
		$sql = "UPDATE `orders` SET `status`='Complete', dateComplete = NOW() + INTERVAL 10 HOUR WHERE `orderNo`='$orderNumber';";
	}
    if($db->runASqlQuery($sql)){
        header("Location:assigned.php");
    }
    else{
        header("Location:error.php");
    }
}
