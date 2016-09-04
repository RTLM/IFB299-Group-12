<?php
    include 'connect.php';
        if(isset($_POST["emailId"]) ||isset($_POST["destination"]) || isset($_POST["pickup"]) || isset($_POST["receiversName"]) || isset($_POST["receiversContact"])){
	$email = htmlspecialchars($_POST["email"]);
	$destination = htmlspecialchars($_POST["destination"]);
	$pickup = htmlspecialchars($_POST["pickup"]);
        $receiversName = htmlspecialchars($_POST["receiversName"]);
        $receiversContact = htmlspecialchars($_POST["receiversContact"]);
	$error = false;
	$errorMessage = "";
	if(strlen($email) == 0 || strlen($destination) == 0 || strlen($pickup) == 0 || strlen($receiversName) == 0 || strlen($receiversContact) == 0 ){
		$error = true;
		$errorMessage ="* Fields are required$receiversContact.<br>";
	}
	/*if (!preg_match("/^[a-zA-Z ]*$/",$destination) || !preg_match("/^[a-zA-Z ]*$/",$pickup)) {
		$error = true;
		$errorMessage = $errorMessage."Name and Last name fields can only contain aphabets.<br>"; 
	}*/
	if (strlen($email)>0 && (filter_var($email, FILTER_VALIDATE_EMAIL) == false)) {
		$error = true;
		$errorMessage = $errorMessage."Invalid email format.<br>"; 
        }
	if(!$error){
            $mysqlst = $conn->prepare("Insert into orders(emailId,destination,pickUp,recieversContact,receiversName,`status`) values('$email','$destination','$pickup','$receiversContact','$receiversName','Pending');");
            $mysqlst->execute();
	}
        else{
            echo $errorMessage;
        }
}
?>
<html>
    <body>
        <form name ="orders" method="post" action =<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>>
            <input name="email" type ="text">email<br>
            <input name="destination" type="text">destination<br>
            <input name="pickup"type =" text">pickup<br>
            <input name="receiversContact"type="text">recievers contact <br>
            <input name="receiversName"type="text"> receivers name <br>
            <input type="submit" action="submit">
        </form>
    </body>
</html>

