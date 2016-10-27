<?php
    session_start();
    if($_SESSION["login"] != true){
        header("Location:index.php");
        exit;
    }
    include 'database.php';
	$db = new database;
	$db->connectToDatabase();
	$sql = ("SELECT accounts.accountNo, contactNo, firstName, lastName, address, emailId, password FROM accounts INNER JOIN customers ON accounts.accountNo = customers.accountNo WHERE accounts.accountNo=".$_SESSION["accountNo"].";");
	$result = $db->getArrayOfValues($sql);
	$row = $result[0];
	$emailId = $row['emailId'];
	$contact = $row['contactNo'];
	$address = $row['address'];
	$firstName = $row['firstName'];
	$lastName = $row['lastName'];
	$password = $row['password'];
?>
<!DOCTYPE html>

<html lang="en">
  <?php
    include 'head.php';
  ?>
  <body>
	<?php
	include('navbar.php');
	if ($_GET['pwd'] == "fail") { ?>
		<h2 class="text-center">Password change failed - Password did not match</h2>
	<?php } else if ($_GET['pwd'] == "success") {
	?>
		<h2 class="text-center">Password change successful</h2>
	<?php } ?>
	<div class="container">
	<h2 class="text-center">Account Details</h2>
            <div class="col-md-8 col-md-offset-2" style="float: none; background-color:#eee">
                <form method="POST" action="updateDetails.php">
                    <div class="form-group">
                          <label for="email">Email Address:</label>
                          <input type="email" class="form-control" id="email" name="email" value="<?php echo $emailId;?>">
                    </div>
                    <div class="form-group">
                          <label for="contact">Contact Number:</label>
                          <input type="tel" class="form-control" id="contact" name="contact" value="<?php echo $contact;?>">
                    </div>
                    <div class="form-group">
                          <label for="address">Address:</label>
                          <input type="text" class="form-control" id="address" name="address" value="<?php echo $address;?>">
                    </div>
                    <div class="form-group">
                          <label for="firstname">First Name:</label>
                          <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $firstName;?>">
                    </div>
                    <div class="form-group">
                          <label for="lastname">Last Name:</label>
                          <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $lastName;?>">
                    </div>
					<button type="button" class="btn btn-info" data-toggle="modal" data-target="#passwordModal">Change Password</button>					
                    <button id="submit" name="submit" type="submit" class="btn btn-primary">Update Details</button>		
                </form>
            </div>
	</div>
	
	<!-- Modal -->
	<div id="passwordModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Change Password</h4>
				</div>
				<div class="modal-body">
					<form action="changePassword.php" method="post">	
						<div class="form-group">
							<label for="oldpassword">Old Password:</label>
							<input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Old Password">
						</div>
						<div class="form-group">
							<label for="newpassword">New Password:</label>
							<input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="New Password">
						</div>
						<div class="form-group">
						<input type="hidden" value=<?php echo $row['orderNo']; ?> name="orderNo" />
						</div> 
						<div class="modal-footer">
							<button id="submit" name="submit" type="submit" value="Update Estimated-Date" class="btn btn-primary">Submit</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
      <?php
        include "tail.php";
      ?>
	  
  </body>
</html>