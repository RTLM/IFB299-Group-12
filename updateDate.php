<?php
	include "database.php";
	$db = new database;
	$db->connectToDatabase();
	if(isset($_POST['date'])) {
		$date = $_POST['date'];
		$orderNo = htmlspecialchars($_POST['orderNo']);
		$updateDate = 
                "
                UPDATE orders SET estimatedDelivery = '$date' WHERE `orderNo` = '$orderNo';
                ";
                $db->runASqlQuery($updateDate);
	}
	header("location:orderDetails.php?order=$orderNo");
	exit;
	
	?>