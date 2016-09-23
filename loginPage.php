<?php
session_start();
include 'database.php';
    $db = new database;
    if(isset($_POST["email"]) ||isset($_POST["password"])){
        $email = htmlspecialchars($_POST["email"]);
        $password  =  htmlspecialchars($_POST["password"]);
        if($db->checkInputsIfEmpty($email)==false && $db->checkInputsIfEmpty($password)==false){ 
           if($db->connectToDatabase()!=false){
                $user = $db->checkCredentials($email, $password);
                if($user!=false){
                    $_SESSION["login"] = true;
                    $_SESSION["emailId"] = $user["emailId"];
                    $_SESSION["accountNo"] = $user["accountNo"];
                    $_SESSION["accountType"] = $user["accountType"];
					if ($_SESSION["accountType"] == "Owner" || $_SESSION["accountType"] == "Driver") {
						header("Location:delivery.php");
					} else {
						header("Location:index.php");
					}
                }
                else{
                    $_SESSION["error"] = true;
                    $_SESSION["errorMessage"] = "Check Username and Password";
                    header("Location:signin.php");
                } 
           }
           else{
               $_SESSION["error"] = "Cannot access database";
               header("Location:error.php");
           }
        }
        else{
            if($db->checkInputsIfEmpty($email)==true){
                $_SESSION["error"] = true;
                $_SESSION["errorMessage"] = "Email and Password Needed";
            }
            if($db->checkInputsIfEmpty($password)==true){
                $_SESSION["error"] = true;
                $_SESSION["errorMessage"] = "Email and Password Needed";;
            }
            header("Location:signin.php");
        }      
}
else{
    header("Location:index.php");
}