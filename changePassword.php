<?php 
echo "test";
session_start();
include 'database.php';
$old = htmlspecialchars($_POST['oldpassword']);
$new = htmlspecialchars($_POST['newpassword']);

		// SET emailId=".$emailId.", contactNo=".$contact.", address=".$address.", firstName=".$firstName.", lastName=".$lastName." 
// FROM accounts   a.emailId=".$emailId." c.contactNo=".$contact." c.address=".$address.", c.firstName=".$firstName.", c.lastName=".$lastName." 
		// INNER JOIN customers ON accounts.accountNo = customers.accountNo

$sql = "UPDATE accounts
		SET password='".$new."'
		WHERE accountNo=".$_SESSION["accountNo"]." 
		AND password='".$old."';";
echo "test";
$db = new database;
$db->connectToDatabase();
if($db->runASqlQuery($sql)){
	header("Location:accountDetails.php");
} else {
	header("Location:accountDetails.php");
}
?>