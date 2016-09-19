<?php
	session_start();
	
	include 'connect.php';
	global $conn;
	
	if(isset($_POST['email'])) {

		$email = $_POST['email'];
		$contact = $_POST['receiverscontact'];
		$destination = $_POST['destination'];
		$name = $_POST['receiversname'];
		$pickup = $_POST['pickup'];
		$status = "Pending";
		$date = date("Y-m-d");
		$id = $_SESSION['accountNo'];
		
		try 
		{
			$sql = 
			"INSERT INTO orders(accountNo, destination, pickUp, receiversName, receiversContact, status, orderDate) VALUES ('$id', '$destination', '$pickup', '$name', '$contact', '$status', '$date')";
			// use exec() because no results are returned
			$conn->exec($sql);
			echo "New record created successfully";
		}
		catch(PDOException $e)
		{
			echo $sql . "<br>" . $e->getMessage();
		}
	}
	header("location:index.php");
	exit;
?>