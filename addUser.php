<?php
	include 'connect.php';
	global $conn;
	
	if(isset($_POST['email'])) {

		$email = $_POST['email'];
		$contact = $_POST['contact'];
		$address = $_POST['address'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$password = $_POST['password'];
		$accountType = 'Customer';		

		try {
			$addAccount = 
			"
			INSERT INTO accounts(emailId, password, accountType) VALUES ('$email', '$password', '$accountType');
			INSERT INTO customers(accountNo, address, contactNo, firstName, lastName) VALUES (LAST_INSERT_ID(), '$address', '$contact', '$firstname', '$lastname');
			";
			// use exec() because no results are returned
			$conn->exec($addAccount);
			echo "New record created successfully";
			}
		catch(PDOException $e)
			{
			echo $addAccount . "<br>" . $e->getMessage();
			}		
	}
	header("location:index.php");
	exit;
?>