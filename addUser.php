<?php
	include 'database.php';
	if(isset($_POST['email'])) {
		$emailId = htmlspecialchars($_POST['email']);
		$contact = htmlspecialchars($_POST['contact']);
		$address = htmlspecialchars($_POST['address']);
		$firstName = htmlspecialchars($_POST['firstname']);
		$lastName = htmlspecialchars($_POST['lastname']);
		$password = htmlspecialchars($_POST['password']);
		$accountType = 'Customer';
                $db = new database;
                $db->connectToDatabase();
                $db->makeAccount($emailId, $address, $contact, $firstName, $lastName, $password, $accountType);
}//end if
