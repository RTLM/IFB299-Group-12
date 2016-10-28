<!DOCTYPE html>
<html lang="en">
  <?php
    session_start();
    if($_SESSION["login"] !=true){
        header("Location:signin.php");
    }
    global $nameError;
    global $nameLabel;
    global $nameLabelColor;
    $nameLabelColor = "Black";
    $nameLabel = "Name:";
    $nameError = $_SESSION["invalidName"];
    if($nameError){
    	$nameLabel="Invalid Name";
    	$nameLabelColor = red;
    	unset($_SESSION["invalidName"]);
    }
    global $contactError;
    global $contactLabel;
    global $contactLabelColor;
    $contactLabel = "Receivers Contact:";
    $contactLabelColor = "Black";
    $contactError = $_SESSION["invalidContact"];
    if($contactError){
    	$contactLabel = "Invalid Contact";
    	$contactLabelColor = "red";
    	unset($_SESSION["invalidContact"]);
    }
    global $weightError;
    global $weightLabel;
    global $weightLabelColr;
    $weightLabel = "Weight:(Kgs)";
    $weightLabelColr = "black";
    $weightError = $_SESSION["invalidWeight"];
    if($weightError){
    	$weightLabel = "Weight must be < 22 & > 0";
    	$weightLabelColr = "red";
    	unset($_SESSION["invalidWeight"]);
    }

    global $destinationError;
    global $destinationOutsideBrisbane;
    global $destinationLabel;
    global $destinationLabelColor;
    $destinationLabel = "Destination:";
    $destinationLabelColor = "black";
    $destinationError = $_SESSION["invalidDestination"];
    $destinationOutsideBrisbane = $_SESSION["destinationOutsideBrisbane"];
    if($destinationError){
    	$destinationLabel = "Invalid Destination!!!";
    	$destinationLabelColor = "red";
    	unset($_SESSION["invalidDestination"]);
    }
    else if($destinationOutsideBrisbane){
    	$destinationLabel = "Destination must be in Brisbane!!!";
    	$destinationLabelColor = "red";
    	unset($_SESSION["destinationOutsideBrisbane"]);
    }

    global $pickupError;
    global $pickupOutsideBrisbane;
    global $pickupLabel;
    global $pickupLabelColor;
    $pickupLabel = "Pickup:";
    $pickupLabelColor = "black";
    $pickupError = $_SESSION["invalidPickup"];
    $pickupOutsideBrisbane = $_SESSION["pickupOutsideBrisbane"];
    if($pickupError){
    	$pickupLabel = "Invalid Pickup!!!";
    	$pickupLabelColor = "red";
    	unset($_SESSION["invalidPickup"]);
    }
    else if($pickupOutsideBrisbane){
    	$pickupLabel = "Pickup must be in Brisbane!!!";
    	$pickupLabelColor = "red";
    	unset($_SESSION["pickupOutsideBrisbane"]);
    }
    include "head.php";
  ?>
    <style>
		body {
			background-image: url("background.jpg");
		} 
		
		.myBackground {
		  background-color: rgba(255,255,255, 0.6);
		  color: inherit;
		}
	</style>
    <body onload="prepareOrder();">
        <?php
            include 'navbar.php';
            include 'database.php';
            $db = new database;
            $db->connectToDatabase();
            $sqlSt = "SELECT address FROM customers WHERE accountNo = ".$_SESSION["accountNo"].";";
            $result = $db->getArrayOfValues($sqlSt);
            $row = $result[0];
        ?>
			<div class="container" style="padding-top: 1cm;">
			<div class="col-md-8 col-md-offset-2 myBackground" style="border-top-left-radius: 10px; border-top-right-radius: 10px; " >
			<h2 class="text-center">New Order</h2>
			<!--<center><img src="padlock-closed2.png" style="width: 25px; height:30px;"></center>-->
			</div>
				<div class="col-md-8 col-md-offset-2 myBackground" style=" margin-bottom: 1cm; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px; padding-bottom: 1cm;">
					<form method="POST" action="orderConfirmation.php">
					<div class="form-group">
						<label for="destination" id="destinationLabel" style = "color:<?php echo $destinationLabelColor; ?>"><?php echo $destinationLabel;?></label>
						<input type="text" class="form-control" id="destination" name="destination" placeholder="Sending To" onchange ="doGeocode('destination');" autocomplete="off">
					</div>
					<div class="form-group">
						<label for="pickup" id="pickupLabel" style = "color:<?php echo $pickupLabelColor; ?>"><?php echo $pickupLabel;?></label>
						<input type="text" class="form-control" id="pickup" name="pickup" value="<?php echo $row['address']?>" placeholder="Sending From" onchange="doGeocode('pickup');" autocomplete="off">
					</div>
					<div class="form-group">
						<label id="receiversnameLabel" id="receiversnameLabel" for="receiversname" style = "color:<?php echo $nameLabelColor; ?>"><?php echo $nameLabel;?></label>
						<input type="text" class="form-control" id="receiversname" name="receiversname" placeholder="Receiver's Name" onkeydown="validate('receiversname','name');" autocomplete="off">
					</div>
					<div class="form-group">
						<label id = "receiverscontactLabel" for="receiverscontact" style = "color:<?php echo $contactLabelColor; ?>"><?php echo $contactLabel;?></label>
						<input type="tel" class="form-control" id="receiverscontact" name="receiverscontact" placeholder="Receiver's Contact Number" onkeydown="validate('receiverscontact','number');" autocomplete="off">
					</div>
					<div class="form-group">
						<label id = "weightLabel" for="weight" style = "color:<?php echo $weightLabelColr; ?>"><?php echo $weightLabel;?></label>
						<input type="text" class="form-control" id="weight" name="weight" placeholder="Package Weight in Kilograms" onkeydown="validate('weight','weight');" autocomplete="off">
					</div>	
					<div class="form-group">
						<label id = "sizeLabel" for="size">Package Size:</label>
						<select class="form-control" id="size" name="size">
							<option hidden value="" selected disabled>Select a Size</option>
							<option value="Envelope">Envelope (Up to 22cm x 33.5cm)</option>
							<option value="Small">Small (Up to 20cm&#179;)</option>
							<option value="Medium">Medium (Up to 35cm&#179;)</option>
							<option value="Large">Large (Up to 45cm&#179;)</option>
							<option value="X-Large">X-Large (Up to 70cm&#179;)</option>
						</select>
					</div>									
					<div class="form-group">
						<label for="priority">Package Priority:</label>
						<select class="form-control" id="priority" name="priority">
							<option value="3">Standard (5-7 Working Days)</option>
							<option value="2">Express (2-4 Working Days) (+$5)</option>
							<option value="1">Overnight (1 Working Day) (+$10)</option>
						</select>
					</div>
					<div class="form-group">
						<label for="valuable">Signature Required?</label>
						<select class="form-control" id="valuable" name="valuable">
							<option value="FALSE">No</option>
							<option value="TRUE">Yes</option>
						</select>
					</div>
					<div id = "addressDiv" style="display: none;">
					</div>
					 <button type="submit" name="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
        <?php
            include "tail.php";
        ?>
  </body>
</html>