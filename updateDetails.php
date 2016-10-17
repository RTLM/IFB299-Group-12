<?php 
echo "test";
session_start();
include 'database.php';
$emailId = htmlspecialchars($_POST['email']);
$contact = htmlspecialchars($_POST['contact']);
$address = htmlspecialchars($_POST['address']);
$firstName = htmlspecialchars($_POST['firstname']);
$lastName = htmlspecialchars($_POST['lastname']);
echo "test";

		// SET emailId=".$emailId.", contactNo=".$contact.", address=".$address.", firstName=".$firstName.", lastName=".$lastName." 
// FROM accounts   a.emailId=".$emailId." c.contactNo=".$contact." c.address=".$address.", c.firstName=".$firstName.", c.lastName=".$lastName." 
		// INNER JOIN customers ON accounts.accountNo = customers.accountNo

$sql = "UPDATE customers c
		JOIN accounts a
			ON c.accountNo = a.accountNo
		SET c.contactNo='".$contact."', a.emailId='".$emailId."', c.address='".$address."', c.firstName='".$firstName."', c.lastName='".$lastName."'
		WHERE c.accountNo=".$_SESSION["accountNo"]." ;";
echo "test";
$db = new database;
$db->connectToDatabase();
if($db->runASqlQuery($sql)){
	header("Location:" . $_SERVER['HTTP_REFERER']);
}
?>