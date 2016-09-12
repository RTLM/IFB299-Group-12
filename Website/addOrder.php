<?php
	include 'connect.php';
	if(isset($_POST['email'])) {

		$email = $_POST['email'];
		$contact = $_POST['receiverscontact'];
		$destination = $_POST['destination'];
		$name = $_POST['receiversname'];
		$pickup = $_POST['pickup'];
		$status = "Pending";
		
		$sql = "INSERT INTO orders(emailId, destination, pickUp, receiversName, receiversContact, status) VALUES ('$email', '$destination', '$pickup', '$name', '$contact', '$status')";

		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	header("location:index.php");
	exit;
?>