<?php
include "database.php";
if(isset($_POST["driver"])){
    $db = new database;
    $db->connectToDatabase();
    $driver = htmlspecialchars($_POST["driver"]);
    echo "<script>console.log('$driver')</script>";
    $orderNumber = htmlspecialchars($_POST["orderNumber"]);
    $sql = "UPDATE `orders` SET `driver`='$driver' WHERE `orderNo`='$orderNumber';";
    if($db->runASqlQuery($sql)){
        header("Location:unassigned.php");
    }
    else{
        header("Location:error.php");
    }
}

?>
