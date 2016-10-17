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
	?>
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
                    <button id="submit" name="submit" type="submit" class="btn btn-primary">Update Details</button>

                </form>
            </div>
	</div>
      <?php
        include "tail.php";
      ?>
  </body>
</html>