<?php
    session_start();
    include 'connect.php';
        if(isset($_POST["emailId"]) ||isset($_POST["destination"]) || isset($_POST["pickup"]) || isset($_POST["receiversName"]) || isset($_POST["receiversContact"])){
	$email = htmlspecialchars($_POST["email"]);
	$firstName = htmlspecialchars($_POST["destination"]);
	$lastName = htmlspecialchars($_POST["pickup"]);
        $address = htmlspecialchars($_POST["receiversName"]);
        $contact = htmlspecialchars($_POST["receiversContact"]);
	$error = false;
	$errorMessage = "";
	if(strlen($email) == 0 || strlen($firstName) == 0 || strlen($lastName) == 0 || strlen($address) == 0 || strlen($contact) == 0 ){
		$error = true;
		$errorMessage ="* Fields are required$contact.<br>";
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
            
            $checkIfUserExist = $conn->prepare("select * from customers where emailId = '$email';");
            $checkIfUserExist->execute();
            if($checkIfUserExist->rowCount() == 1){
                $mysqlst = $conn->prepare("Insert into orders(emailId,destination,pickUp,recieversContact,receiversName,`status`) values('$email','$firstName','$lastName','$contact','$address','Pending');");
                $mysqlst->execute();
                $orderNumber = $conn->prepare("select * from orders where emailId = '$email'");
                $orderNumber->execute();
                $lastRow = false;
                $orderId;
                while($lastRow == false){
                    if(($orderIdTemp = $orderNumber->fetch(PDO::FETCH_ASSOC))){
                        $orderId = $orderIdTemp["orderNumber"];
                       $lastRow = false; 
                    }
                    else{
                        $lastRow = true;  
                    }
                }
                $_SESSION["currentOrder"]=$orderId;
            }
            else{
                $error = true;
                $errorMessage = "User Doesnt exist";
                echo $errorMessage;
            }
	}
}
?>
<html>
    <?php
    include'head.php';
    ?>
    <body>
        <div class="HPwrapperOfMainBody">
            <?php
            include'header.php';
            ?>
            <div class="OPformWrapper">
                <form name ="orders" method="post" action =<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>>
                    <input class="OPinput" name="email" type ="text"placeholder="Email">
                    <input class="OPinput" name="destination" type="text"placeholder="Destination">
                    <input class="OPinput" name="pickup"type =" text"placeholder="Pickup">
                    <input class="OPinput" name="receiversContact"type="text"placeholder="Recivers Contact Number">
                    <input class="OPinput" name="receiversName"type="text" placeholder="Receivers Name">
                    <input class="OPinput" type="submit" action="submit">
                </form>
            </div>    
        </div>
    </body>
</html>

