<?php
	include "database.php";
        $db = new database;
        $db->connectToDatabase();
	if(isset($_POST['weight']) || isset($_POST['size'])) {
		$weight = htmlspecialchars($_POST['weight']);
		$size = htmlspecialchars($_POST['size']);
		$orderNo = htmlspecialchars($_POST['orderNo']);
		$updateWeightSize = 
                "
                UPDATE orders SET size = '$size', weight = '$weight' WHERE `orderNo` = '$orderNo';
                ";
                $db->runASqlQuery($updateWeightSize);
	header("location:" . $_SERVER['HTTP_REFERER']);
	exit;
        }