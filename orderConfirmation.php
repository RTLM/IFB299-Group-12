<?php
    session_start();
    include "database.php";
    $email = $_SESSION["emailId"];
    $accountNo = $_SESSION["accountNo"];
    $receiversContact = htmlspecialchars($_POST['receiverscontact']);
    $destination = htmlspecialchars($_POST['destination']);
    $receiversName = htmlspecialchars($_POST['receiversname']);
    $pickup = htmlspecialchars($_POST['pickup']);
	  $priority = htmlspecialchars($_POST['priority']);
	  $valuable = htmlspecialchars($_POST['valuable']);
    $status = "Pending";
    $date = date("Y-m-d");
    $error = false;
    $id = $_SESSION['accountNo'];
    $db = new database;
    if($db->invalidate($receiversName,"name")){
      $_SESSION["invalidName"] = true;
      $error = true;
    }
    if($db->invalidate($receiversContact,"number")){
      $_SESSION["invalidContact"] = true;
      $error = true;
    }
    if(intval(htmlspecialchars($_POST["weight"])) > 22 || intval(htmlspecialchars($_POST["weight"])) <=0){
      $_SESSION["invalidWeight"] = true;
      $error = true;
    }
    if(strlen($destination) < 5){
      $_SESSION["invalidDestination"] = true;
      $error = true;
    }
    if(strlen($pickup)<5){
      $_SESSION["invalidPickup"] = true;
      $error = true;
    }

    if($error){
      header("Location:order.php");
    }
	$prioritydate = date_create($date);
	switch (htmlspecialchars($_POST['priority'])) {
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
	$size = htmlspecialchars($_POST['size']);
	$weight = htmlspecialchars($_POST['weight']);
    $sql = "INSERT INTO orders(accountNo, destination, pickup, receiversName, receiversContact, status, orderDate, estimatedDelivery, priority, size, weight, valuable) 
			values('$accountNo','$destination','$pickup','$receiversName','$receiversContact','$status','$date','$estimatedDelivery', '$priority', '$size', '$weight', '$valuable');";
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
                        <label for="weight">Package Weight:</label>
                        <p class="form-control-static"><?php echo $_POST['weight'] . ' Kgs'; ?></p>
                  </div>
				  <div class="form-group">
                        <label for="size">Package Size:</label>
                        <p class="form-control-static"><?php echo $_POST['size']; ?></p>
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
				  <div class="form-group">
                        <label for="valuable">Signature Required:</label>
                        <p class="form-control-static"><?php 
							switch ($valuable) {
								case 'FALSE':
									echo "No";
									break;
								case "TRUE":
									echo "Yes";
									break;
							}
						?></p>
                  </div>
				  <h2 class="text-center">The Price of Your Order Comes to: $<?php echo packageCost($_POST['priority'], $_POST['size'], $_POST['weight']); ?></h2>				  
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
