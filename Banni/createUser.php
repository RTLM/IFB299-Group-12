<?php
    include 'connect.php';
    if(isset($_POST["email"]) ||isset($_POST["address"]) || isset($_POST["firstName"]) || isset($_POST["lastName"]) || isset($_POST["contact"])){
	$email = htmlspecialchars($_POST["email"]);
	$destination = htmlspecialchars($_POST["firstName"]);
	$pickup = htmlspecialchars($_POST["lastName"]);
        $receiversName = htmlspecialchars($_POST["address"]);
        $receiversContact = htmlspecialchars($_POST["contact"]);
	$error = false;
	$errorMessage = "";
	if(strlen($email) == 0 || strlen($destination) == 0 || strlen($pickup) == 0 || strlen($receiversName) == 0 || strlen($receiversContact) == 0 ){
		$error = true;
		$errorMessage ="* Fields are required.<br>";
	}
	if (!preg_match("/^[a-zA-Z ]*$/",$destination) || !preg_match("/^[a-zA-Z ]*$/",$pickup)) {
		$error = true;
		$errorMessage = $errorMessage."Name and Last name fields can only contain aphabets.<br>"; 
	}
	if (strlen($email)>0 && (filter_var($email, FILTER_VALIDATE_EMAIL) == false)) {
		$error = true;
		$errorMessage = $errorMessage."Invalid email format.<br>"; 
        }
	if(!$error){
            $emailExist = false;
            $checkEmail = $conn->prepare("select * from customers where emailId = '$email'");
            $checkEmail->execute();
            if($checkEmail->rowCount()==0){
                $createUser = $conn->prepare("insert into customers values('$email','$receiversName','$receiversContact','$firstName','$pickup')");
                $createUser->execute();
            }
            else{
                $error = true;
                $errorMessage = "User Exist";
            }
	}
}
?>
<html>
    <body>
        <form name="order" action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method="post">
            <input type="text" name="email">email<br>
            <input name="contact" type="text">contact<br>
            <input type="text" name="address">address<br>
            <input type="text" name="firstName">first Name<br>
            <input type="text" name="lastName">last Name<br>
            <input type ="submit" action="submit"><?php if($error){echo $errorMessage;}?>
        </form>
    </body>
</html>



