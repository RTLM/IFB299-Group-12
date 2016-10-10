<?php
    session_start();

    $email = $_SESSION["emaiId"];
    $accountNo = $_SESSION["accountNo"];
    $receiversContact = htmlspecialchars($_POST['receiverscontact']);
    $destination = htmlspecialchars($_POST['destination']);
    $receiversName = htmlspecialchars($_POST['receiversname']);
    $pickup = htmlspecialchars($_POST['pickup']);
	$priority = htmlspecialchars($_POST['priority']);
    $status = "Pending";
    $date = date("Y-m-d");
    $id = $_SESSION['accountNo'];
	$prioritydate = date_create($date);
	switch ($_POST['priority']) {
		case 1:
			date_add($prioritydate, date_interval_create_from_date_string('1 weekdays'));
			break;
		case 2:
			date_add($prioritydate, date_interval_create_from_date_string('3 weekdays'));
			break;
		case 3:
			date_add($prioritydate, date_interval_create_from_date_string('5 weekdays'));
			break;
	}
	$estimatedDelivery = date_format($prioritydate, 'Y-m-d');
    $sql = "insert into orders(accountNo, destination, pickup, receiversName, receiversContact, status, orderDate, estimatedDelivery, priority) values('$accountNo','$destination','$pickup','$receiversName','$receiversContact','$status','$date','$estimatedDelivery', '$priority');";
	$_SESSION["orderSQL"] = $_SESSION["orderSQL"].$sql;
    ?>
<!DOCTYPE html>
<html lang="en">
    <?php
      include "head.php";
    ?>
  <body>
	<?php
            include 'navbar.php';
        ?>
		<h2 class="text-center">Is Your Order Correct?</h2>
            <div class="col-md-6 col-md-offset-3" style="float: none; background-color:#eee">
    
                <form method="POST" action="addOrder.php">
                  <div class="form-group">
                        <label for="email">Email Address:</label>
                        <p class="form-control-static"><?php echo $_SESSION['emailId'];
						?></p>
                  </div>
                  <div class="form-group">
                        <label for="destination">Destination:</label>
                        <p class="form-control-static"><?php echo $_POST['destination']; ?></p>
                  </div>
                  <div class="form-group">
                        <label for="pickup">Pick Up:</label>
                        <p class="form-control-static"><?php echo $_POST['pickup']; ?></p>
                  </div>
                  <div class="form-group">
                        <label for="receiversname">Receiver's Name:</label>
                        <p class="form-control-static"><?php echo $_POST['receiversname']; ?></p>
                  </div>
                  <div class="form-group">
                        <label for="receiverscontact">Receiver's Contact Number:</label>
                        <p class="form-control-static"><?php echo $_POST['receiverscontact']; ?></p>
                  </div>				  
                  <div class="form-group">
                        <label for="priority">Package Priority:</label>
                        <p class="form-control-static"><?php 
							switch ($priority) {
								case 1:
									echo "Overnight";
									break;
								case 2:
									echo "Express";
									break;
								case 3:
									echo "Standard";
									break;
							}
						?></p>
                  </div>	  
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  <a href="order.php" class="btn btn-primary" role="button">Add Order</a>
                  <a href="cancelOrder.php" class="btn btn-danger" role="button">Cancel</a>
                </form>
            </div>
	</div>
    <?php
        include "tail.php";
    ?>
  </body>
</html>
