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
			$sql = ("SELECT orderNo, size, weight, destination, receiversName, receiversContact, status, pickUp, orderDate, contactNo, firstName, lastName FROM orders join customers WHERE orderNo =" .$_GET['order'].";");
			$result = $db->getFetchValue($sql);
        ?>

	<div class="row top30">
	<div class="center-block col-md-4 " style="float: none; background-color:#eee">
	<div class="text-center">
	<h2>Order # <?php echo $result['orderNo']; ?> </h2>
	</div>
	<div class="text-center">
	<p>
		Sending From: <?php echo $result['pickUp']; ?><br>
		Sending To: <?php echo $result['destination']; ?><br>
		Size: <?php if(isset($result['size'])) { echo $result['size'] . ' cm';
		} else { echo '-' ;}; ?><br>
		Weight: <?php if(isset($result['weight'])) { echo $result['weight'] . ' Kgs';
		} else { echo '-' ;}; ?><br>
		Sender: <?php echo $result['firstName'] . ' ' . $result['lastName']; ?><br>
		Sender's Contact Number: <?php echo $result['contactNo']; ?><br>
		Receiver: <?php echo $result['receiversName']; ?><br>
		Receiver's Contact Number: <?php echo $result['receiversContact']; ?><br>
		Status: <?php echo $result['status']; ?><br>
		Estimated Delivery: <?php 
		$date = new DateTime($result['orderDate']);
		date_add($date, date_interval_create_from_date_string('5 weekdays'));
		echo $date->format('d/m/Y'); ?>
	</p>
	<p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#weightSizeModal">Update Weight and Size</button>
	<a class="btn btn-success" href="delivery.php" role="button">Done</a></p>
	</div>
	</div>	
</div>

<!-- Modal -->
<div id="weightSizeModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Weight and Size</h4>
      </div>
      <div class="modal-body">
	  <form method="POST" action="updateWeightSize.php">	
	  <div class="form-group">
		<label for="weight">Weight (Kgs):</label>
		<input type="text" class="form-control" id="weight" name="weight" placeholder="Weight e.g. 0.5">
	  </div>
	  <div class="form-group">
		<label for="size">Size (Cms):</label>
		<input type="text" class="form-control" id="size" name="size" placeholder="Size e.g. 10x10x10">
	  </div>  
	  <div class="form-group">
	  		<input type="hidden" value=<?php echo $result['orderNo']; ?> name="orderNo" />
		</div> 
	  
	  

      </div>
      <div class="modal-footer">
	  <button id="submit" name="submit" type="submit" value="Update Weight-Size" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
	  	</form>
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