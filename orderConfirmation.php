<?php
    session_start();
    $email = $_SESSION["emaiId"];
    $accountNo = $_SESSION["accountNo"];
    $receiversContact = htmlspecialchars($_POST['receiverscontact']);
    $destination = htmlspecialchars($_POST['destination']);
    $receiversName = htmlspecialchars($_POST['receiversname']);
    $pickup = htmlspecialchars($_POST['pickup']);
    $status = "Pending";
    $date = date("Y-m-d");
    $id = $_SESSION['accountNo'];
    $sql = "insert into orders(accountNo, destination, pickup, receiversName, receiversContact, status, orderDate) values('$accountNo','$destination','$pickup','$receiversName','$receiversContact','$status','$date');";
    $_SESSION["orderSQL"] = $_SESSION["orderSQL"].$sql;
    ?>
<!DOCTYPE html>
<html lang="en">
    <?php
      include "head.php";
    ?>
  <body>
	<?php
            include 'selectNav.php';
        ?>
	<div class="row top30">
            <div class="center-block col-md-4 " style="float: none; background-color:#eee">
                <div class="text-center">
                <h2>Is Your Order Correct?</h2>
                </div>
                <form method="POST" action="addOrder.php">
                  <div class="form-group">
                        <label for="email">Email Address:</label>
                        <p class="form-control-static"><?php echo $_SESSION['emailId']; ?></p>
                        <input type="hidden" value=<?php echo $_POST['email']; ?> name="email" />
                  </div>
                  <div class="form-group">
                        <label for="destination">Destination:</label>
                        <p class="form-control-static"><?php echo $_POST['destination']; ?></p>
                        <input type="hidden" value=<?php echo $_POST['destination']; ?> name="destination" />
                  </div>
                  <div class="form-group">
                        <label for="pickup">Pick Up:</label>
                        <p class="form-control-static"><?php echo $_POST['pickup']; ?></p>
                        <input type="hidden" value=<?php echo $_POST['pickup']; ?> name="pickup" />
                  </div>
                  <div class="form-group">
                        <label for="receiversname">Receiver's Name:</label>
                        <p class="form-control-static"><?php echo $_POST['receiversname']; ?></p>
                        <input type="hidden" value=<?php echo $_POST['receiversname']; ?> name="receiversname" />
                  </div>
                  <div class="form-group">
                        <label for="receiverscontact">Receiver's Contact Number:</label>
                        <p class="form-control-static"><?php echo $_POST['receiverscontact']; ?></p>
                        <input type="hidden" value=<?php echo $_POST['receiverscontact']; ?> name="receiverscontact" />
                  </div>	  
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  <a href="order.php" class="btn btn-primary" role="button">Add Order</a>
                  <a href="order.php" class="btn btn-danger" role="button">Cancel</a>
                </form>
            </div>
	</div>
    <?php
        include "tail.php";
    ?>
  </body>
</html>
