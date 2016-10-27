<!DOCTYPE html>
<html lang="en">
  <?php
    session_start();
    if($_SESSION["login"] !=true){
        header("Location:signin.php");
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
    <body>
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
					<form method="POST" onsubmit="return submitForm2();" action="orderConfirmation.php">
					<div class="form-group">
						<label for="destination">Destination:</label>
						<input type="text" class="form-control" id="destination" name="destination" placeholder="Sending To" onchange ="doGeocode('destination');" autocomplete="off">
					</div>
					<div class="form-group">
						<label for="pickup">Pick Up:</label>
						<input type="text" class="form-control" id="pickup" name="pickup" value="<?php echo $row['address']?>" onchange="doGeocode('pickup');">
					</div>
					<div class="form-group">
						<label for="receiversname">Receiver's Name:</label>
						<input type="text" class="form-control" id="receiversname" name="receiversname" placeholder="Receiver's Name" onkeydown="validate('receiversname','name')">
					</div>
					<div class="form-group">
						<label for="receiverscontact">Receiver's Contact Number:</label>
						<input type="tel" class="form-control" id="receiverscontact" name="receiverscontact" placeholder="Receiver's Contact Number" onkeydown="validate('receiverscontact','number');">
					</div>
					<div class="form-group">
						<label for="weight">Package Weight (Kgs):</label>
						<input type="text" class="form-control" id="weight" name="weight" placeholder="Package Weight in Kilograms" onkeydown="validate('weight','weight');">
					</div>	
					<div class="form-group">
						<label for="size">Package Size:</label>
						<select class="form-control" id="size" name="size">
							<option hidden value="" selected disabled>Select a Size</option>
							<option value="envelope">Envelope (Up to 22cm x 33.5cm)</option>
							<option value="small">Small (Up to 20cm&#179;)</option>
							<option value="medium">Medium (Up to 35cm&#179;)</option>
							<option value="large">Large (Up to 45cm&#179;)</option>
							<option value="x-large">X-Large (Up to 70cm&#179;)</option>
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
					<button type="submit" name="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
        <?php
            include "tail.php";
        ?>
  </body>
</html>