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
                UPDATE orders SET dateReady = CURRENT_TIMESTAMP WHERE `orderNo` = '$orderNo';
                ";
		} else if ($status == "On Way to Warehouse") {
			$updateDate = 
                "
                UPDATE orders SET datePickUp = CURRENT_TIMESTAMP WHERE `orderNo` = '$orderNo';
                ";
		} else if ($status == "At Warehouse") {
			$updateDate = 
                "
                UPDATE orders SET dateWarehouse = CURRENT_TIMESTAMP WHERE `orderNo` = '$orderNo';
                ";
		} else if ($status == "With Driver For Delivery") {
			$updateDate = 
                "
                UPDATE orders SET dateDelivery = CURRENT_TIMESTAMP WHERE `orderNo` = '$orderNo';
                ";
		} else if ($status == "Complete") {
			$updateDate = 
                "
                UPDATE orders SET dateComplete = CURRENT_TIMESTAMP WHERE orderNo = $orderNo;
                ";
		}		
        $db->runASqlQuery($updateDate);
		echo $orderNo;
	}	
	?>