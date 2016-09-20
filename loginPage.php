<?php
session_start();
include 'database.php';
    $db = new database;
    if(isset($_POST["email"]) ||isset($_POST["password"])){
        $email = htmlspecialchars($_POST["email"]);
        $password  =  htmlspecialchars($_POST["password"]);
        $error = false;
        if($db->checkInputsIfEmpty($email)||$db->checkInputsIfEmpty($password)){
            $error = true;
            $errorMessage = "Both Email and Password required";
        }
        if(!$error){
           $db->connectToDatabase();
           $user = $db->checkIfUserExist($email, $password);
           if($user!=false){
               $_SESSION["login"] = true;
               $_SESSION["emailId"] = $user["emailId"];
               $_SESSION["accountNo"] = $user["accountNo"];
               $_SESSION["accountType"] = $user["accountType"];
           }
        } 
}