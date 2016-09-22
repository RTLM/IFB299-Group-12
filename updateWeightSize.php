<?php
	include 'connect.php';
	global $conn;
	
	
	if(isset($_POST['weight']) || isset($_POST['size'])) {
		$weight = $_POST['weight'];
		$size = $_POST['size'];
		$orderNo = $_POST['orderNo'];
	

		try {
			$updateWeightSize = 
			"
			UPDATE orders SET size = '$size', weight = '$weight' WHERE `orderNo` = '$orderNo';
			";
			// use exec() because no results are returned
			$conn->exec($updateWeightSize);
			echo "New record created successfully";
			}
		catch(PDOException $e)
			{
			echo $updateWeightSize . "<br>" . $e->getMessage();
			}		
	}
	header("location:orderDetails.php?order=$orderNo");
	exit;
?>