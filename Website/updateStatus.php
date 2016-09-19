<?php
	include 'connect.php';
	$id = $_POST['statusComplete'];
	$sql = "UPDATE orders SET status='Complete' WHERE orderNo='$id'";
	if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	header("location:delivery.php");
?>