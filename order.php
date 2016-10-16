<!DOCTYPE html>
<html lang="en">
  <?php
    session_start();
    if($_SESSION["login"] !=true){
        header("Location:signIn.php");
    }
    include "head.php";
  ?>
    <body>
        <?php
            include 'navbar.php';
        ?>
			<div class="container">
			<div class="col-md-8 col-md-offset-2" style="background-color:white">
			<center><img src="padlock-closed2.png" style="width: 25px; height:10px;"></center><!-- used as padding for form, needs to be replaced-->
			</div>
			<div class="col-md-8 col-md-offset-2" style="background-color:#528ae5">
			<h2 class="text-center">New Order</h2>
			<!--<center><img src="padlock-closed2.png" style="width: 25px; height:30px;"></center>-->
			</div>
				<div class="col-md-8 col-md-offset-2" style="background-color:#a8aeb7">
					<form method="POST" action="orderConfirmation.php">
					<div class="form-group">
						<label for="destination">Destination:</label>
						<input type="text" class="form-control" id="destination" name="destination" placeholder="Sending To">
					</div>
					<div class="form-group">
						<label for="pickup">Pick Up:</label>
						<input type="text" class="form-control" id="pickup" name="pickup" placeholder="Sending From">
					</div>
					<div class="form-group">
						<label for="receiversname">Receiver's Name:</label>
						<input type="text" class="form-control" id="receiversname" name="receiversname" placeholder="Receiver's Name">
					</div>
					<div class="form-group">
						<label for="receiverscontact">Receiver's Contact Number:</label>
						<input type="tel" class="form-control" id="receiverscontact" name="receiverscontact" placeholder="Receiver's Contact Number">
					</div>
					<div class="form-group">
						<label for="weight">Package Weight (Kgs):</label>
						<input type="text" class="form-control" id="weight" name="weight" placeholder="Package Weight in Kilograms">
					</div>	
					<div class="form-group">
						<label for="size">Package Size:</label>
						<select class="form-control" id="size" name="size">
							<option hidden value="" selected disabled>Select a Size</option>
							<option value="Small">Small</option>
							<option value="Medium">Medium</option>
							<option value="Large">Large</option>
							<option value="X-Large">X-Large</option>
						</select>
					</div>									
					<div class="form-group">
						<label for="priority">Package Priority:</label>
						<select class="form-control" id="priority" name="priority">
							<option value="3">Standard (5-7 Working Days)</option>
							<option value="2">Express (2-4 Working Days)</option>
							<option value="1">Overnight (1 Working Day)</option>
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