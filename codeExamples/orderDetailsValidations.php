<?php
  /*This code contains the validations for user Input. It will validate the user input
  @author: Navjot Singh Dhaliwal
  */
    session_start();
    include "database.php";
    $email = $_SESSION["emailId"];
    $accountNo = $_SESSION["accountNo"];
    $receiversContact = htmlspecialchars($_POST['receiverscontact']);
    $destination = htmlspecialchars($_POST['destination']);
    $receiversName = htmlspecialchars($_POST['receiversname']);
    $pickup = htmlspecialchars($_POST['pickup']);
	  $priority = htmlspecialchars($_POST['priority']);
	  $valuable = htmlspecialchars($_POST['valuable']);
    $status = "Pending";
    $date = date("Y-m-d");
    $error = false;
    $id = $_SESSION['accountNo'];
    $db = new database;
    if($db->invalidate($receiversName,"name")){
      $_SESSION["invalidName"] = true;
      $error = true;
    }
    if($db->invalidate($receiversContact,"number")){
      $_SESSION["invalidContact"] = true;
      $error = true;
    }
    if(intval(htmlspecialchars($_POST["weight"])) > 22 || intval(htmlspecialchars($_POST["weight"])) <=0){
      $_SESSION["invalidWeight"] = true;
      $error = true;
    }
    if($db->geocode($destination) == false){
      $_SESSION["invalidDestination"] = true;
      $error = true;
    }
    else if($db->checkIfAddressIsInBrisbane($destination) == false){
      $_SESSION["destinationOutsideBrisbane"] = true;
      $error = true;
    }
    if($db->geocode($pickup) == false){
      $_SESSION["invalidPickup"] = true;
      $error = true;
    }
    else if($db->checkIfAddressIsInBrisbane($pickup) == false){
      $_SESSION["pickupOutsideBrisbane"] = true;
      $error = true;
    }
    if($error){
      header("Location:order.php");
    }
	$prioritydate = date_create($date);
	switch (htmlspecialchars($_POST['priority'])) {
		case 1:
			date_add($prioritydate, date_interval_create_from_date_string('1 weekdays'));
			break;
		case 2:
			date_add($prioritydate, date_interval_create_from_date_string('3 weekdays'));
			break;
		case 3:
			date_add($prioritydate, date_interval_create_from_date_string('5 weekdays'));
			break;
	}
	$estimatedDelivery = date_format($prioritydate, 'Y-m-d');
	$size = htmlspecialchars($_POST['size']);
	$weight = htmlspecialchars($_POST['weight']);
    $sql = "INSERT INTO orders(accountNo, destination, pickup, receiversName, receiversContact, status, orderDate, estimatedDelivery, priority, size, weight, valuable) 
			values('$accountNo','$destination','$pickup','$receiversName','$receiversContact','$status','$date','$estimatedDelivery', '$priority', '$size', '$weight', '$valuable');";
	$_SESSION["orderSQL"] = $_SESSION["orderSQL"].$sql;
    ?>