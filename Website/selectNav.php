<?php
	session_start();
	
	if($_SESSION['login']==true){
		if($_SESSION['accountType'] == "Customer") {
			include('navbar_active.php');
		} else if ($_SESSION['accountType'] == "Admin") {
			include('navbar_admin.php');
		}
	}
	else{
		include('navbar.php');
	}
		
?>