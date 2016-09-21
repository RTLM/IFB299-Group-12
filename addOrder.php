<?php
    session_start();
    include 'database.php';
    if($_SESSION['login'] == true) {
        $email = $_SESSION["emaiId"];
        $accountNo = $_SESSION["accountNo"];
        $receiversContact = htmlspecialchars($_POST['receiverscontact']);
        $destination = htmlspecialchars($_POST['destination']);
        $receiversName = htmlspecialchars($_POST['receiversname']);
        $pickup = htmlspecialchars($_POST['pickup']);
        $status = "Pending";
        $date = date("Y-m-d");
        $db = new database;
        $db->connectToDatabase();
        $db->updateOrdersTable($accountNo, $destination, $pickup, $receiversName, $receiversContact, $status, $date);
		header("Location:orderComplete.php");
    }  