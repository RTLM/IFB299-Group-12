<?php
    session_start();
    include 'database.php';
    if($_SESSION['login'] == true) {
        $db = new database;
        $db->connectToDatabase();
        $noError = $db->makeOrder($_SESSION["orderSQL"]);
        if($noError)
        {
            header("Location:orderComplete.php");
        }
        else{
            header("Location:error.php");
        }
    }//end if  