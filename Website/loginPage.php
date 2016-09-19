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
            $user = $conn->prepare("select emailId, accountNo, accountType from accounts where emailId = '$email' and password = '$password';");
            $user->execute();			
            if($user->rowCount() == 1){
				$account = $user->fetch(PDO::FETCH_ASSOC);
                $_SESSION["login"] = true;
                $_SESSION["emailId"] = $account["emailId"];
				$_SESSION["accountNo"] = $account["accountNo"];
				$_SESSION["accountType"] = $account["accountType"];
				
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
