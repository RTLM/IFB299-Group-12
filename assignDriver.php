<?php
include "database.php";
if(isset($_POST["driver"])){
    $db = new database;
    $db->connectToDatabase();
    $driver = htmlspecialchars($_POST["driver"]);
    $orderNumber = htmlspecialchars($_POST["orderNo"]);
    $sql = "UPDATE orders SET driver='$driver', status='Ready For Pickup' WHERE orderNo='$orderNumber';";
    if($db->runASqlQuery($sql)){
        header("Location:". $_SERVER['HTTP_REFERER']);
    }
    else{
        header("Location:error.php");
    }
}

?>
