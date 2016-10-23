<?php
echo "test";
	include "database.php";
	$db = new database;
	$db->connectToDatabase();
	echo "test";
	if(isset($_POST['date'])) {
		echo "test";
		$date = $_POST['date'];
		echo "test";
		$orderNo = htmlspecialchars($_POST['orderNo']);
		$updateDate = 
                "
                UPDATE orders SET estimatedDelivery = '$date' WHERE `orderNo` = '$orderNo';
                ";
				echo "test";
                $db->runASqlQuery($updateDate);
	}
	header("location:orderDetails.php?order=$orderNo");
	exit;
	
	?>