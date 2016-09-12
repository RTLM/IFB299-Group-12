<?php
	include 'connect.php';
	if(isset($_POST['email'])) {

		$email = $_POST['email'];
		$contact = $_POST['contact'];
		$address = $_POST['address'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];	
		
		$sql = "INSERT INTO customers(emailId, address, contactNumber, firstName, lastName) VALUES ('$email', '$address', '$contact', '$firstname', '$lastname')";

		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	header("location:index.php");
	exit;
?>