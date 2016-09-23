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
            include 'selectNav.php';
        ?>
			<div class="container">
			<h2 class="text-center">New Order</h2>
				<div class="col-md-8 col-md-offset-2" style="background-color:#eee">
					<form method="POST" action="orderConfirmation.php" onsubmit="alert('jheiuhu');">
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
					  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
        <?php
            include "tail.php";
        ?>
  </body>
</html>