<!DOCTYPE html>
<html lang="en">
  <?php
    include "head.php";
  ?>

  <body>

	<?php
            include 'selectNav.php';
            include 'database.php';			
			$db = new database;
            $db->connectToDatabase();
			$sql = ("SELECT orderNo, accountNo, destination, receiversName, status, pickUp, orderDate FROM orders WHERE orderNo = ".$_SESSION["lastOrder"].";");
			$result = $db->getFetchValue($sql);
        ?>

	<div class="row top30">
	<div class="center-block col-md-4 " style="float: none; background-color:#eee">
	<div class="text-center">
	<h2>Thank you for your order!</h2>
	</div>
	<div class="text-center">
	<p>
		Sent To: <?php echo $result['receiversName']; ?><br>
		Destination: <?php echo $result['destination']; ?><br>
		Sent From: <?php echo $result['pickUp']; ?><br>
		Status: <?php echo $result['status']; ?><br>
		Estimated Delivery: <?php 
		$date = new DateTime($result['orderDate']);
		date_add($date, date_interval_create_from_date_string('5 weekdays'));
		echo $date->format('d/m/Y'); ?>
	</p>
	<p><a class="btn btn-success" href="index.php" role="button">Done</a></p>
	</div>
	</div>
	
</div>



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
