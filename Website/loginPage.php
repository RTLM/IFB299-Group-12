<?php
session_start();
include 'connect.php';
    if(isset($_POST["email"]) ||isset($_POST["password"])){
        $email = htmlspecialchars($_POST["email"]);
        $password  =  htmlspecialchars($_POST["password"]);
        $error = false;
        if(strlen($email) == 0 || strlen($password)==0){
                $error = true;
                $errorMessage ="* Fields are required<br>";
        }
        if (strlen($email)>0 && (filter_var($email, FILTER_VALIDATE_EMAIL) == false)) {
                $error = true;
                $errorMessage = $errorMessage."Invalid email format.<br>"; 
        }
        if(!$error){
            $checkIfUserExist = $conn->prepare("select * from customers where emailId = '$email' and password = '$password';");
            $checkIfUserExist->execute();
            if($checkIfUserExist->rowCount() == 1){
                $_SESSION["login"] = true;
                $_SESSION["emailId"] = $email;
                header("Location:index.php");
            }
            else{
                header("Location:index.php");
            }
        } 
}
?>
<html>
</html>
