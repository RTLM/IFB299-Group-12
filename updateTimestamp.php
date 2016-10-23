<?php
	include "database.php";
	$db = new database;
	$db->connectToDatabase();
	if(isset($_GET['status'])) {
		$status = $_GET['status'];
		echo $status;
		$orderNo = $_GET['orderNo'];		
		if ($status == "Ready For Pickup") {
			$updateDate = 
                "
                UPDATE orders SET dateReady = NOW() + INTERVAL 10 HOUR WHERE `orderNo` = '$orderNo';
                ";
		} else if ($status == "On Way to Warehouse") {
			$updateDate = 
                "
                UPDATE orders SET datePickUp = NOW() + INTERVAL 10 HOUR WHERE `orderNo` = '$orderNo';
                ";
		} else if ($status == "At Warehouse") {
			$updateDate = 
                "
                UPDATE orders SET dateWarehouse = NOW() + INTERVAL 10 HOUR WHERE `orderNo` = '$orderNo';
                ";
		} else if ($status == "With Driver For Delivery") {
			$updateDate = 
                "
                UPDATE orders SET dateDelivery = NOW() + INTERVAL 10 HOUR WHERE `orderNo` = '$orderNo';
                ";
		} else if ($status == "Complete") {
			$updateDate = 
                "
                UPDATE orders SET dateComplete = NOW() + INTERVAL 10 HOUR WHERE orderNo = $orderNo;
                ";
		}		
        $db->runASqlQuery($updateDate);
		echo $orderNo;
	}	
	?>