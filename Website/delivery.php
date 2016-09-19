<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>On The Spot Delivery</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<body>

<?php
	include 'selectNav.php';
	include 'connect.php';
	
	try 
		{
			$sql = $conn->prepare("SELECT orderNo, destination, receiversName, status, pickUp, accountNo, orderDate FROM orders WHERE status != 'Complete';");
			// use exec() because no results are returned
			$sql->execute();
			$result = $sql->fetchAll();
		}
	catch(PDOException $e)
		{
			echo $sql . "<br>" . $e->getMessage();
		}

	
	if (isset($result)) {
		 // output data of each row
		foreach($result as $row) {
		?>

		<div class="horizontal-center">
			<form action="updateStatus.php" method='POST'>
				<div class="row">
				<div class="col-md-30">
				<div class="panel-group">
				
				<?php
				$now = new DateTime('now');
				$orderDate = new DateTime($row['orderDate']);
				date_add($orderDate, date_interval_create_from_date_string('5 weekdays'));		
				$interval = $now->diff($orderDate);
				if ($interval->days > 3) {
				?>				
				<div class="panel panel-success">
				<?php 
				} else if ($interval->days > 1) {
				?>
				<div class="panel panel-warning">
				<?php 
				} else {
				?>
				<div class="panel panel-danger">
				<?php 
				}
				?>						
				  <div class="panel-heading">Order #<?php echo $row['orderNo']; ?></div>
				  <div class="panel-body">Pick Up: <?php echo $row['pickUp']; ?><br>
					  Customer: #<?php echo $row['accountNo']; ?><br>
					  Deliver To: <?php echo $row['destination']; ?><br>
					  Receiver: <?php echo $row['receiversName']; ?><br>
					  Status: <?php echo $row['status']; ?><br>
					  Deliver By: <?php 
						echo $orderDate->format('d/m/Y'); ?></div>
				  <div class="btn-container-right">
					<button type="submit" name="statusComplete" value=<?php echo $row['orderNo']; ?> class="btn btn-success btn-space">Mark As Complete</button>
					<a href="#" class="btn btn-info btn-space" name role="button">Order Details</a>					
					
				  </div>
				</div>
				</div>
				</div>
				</div>
			</form>
		</div>
		 <?php }
		 }
	
?>
		  <footer>
			<p>&copy; 2016 Company, Inc.</p>
		  </footer>
		</div> <!-- /container -->


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