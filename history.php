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
			$sql = $conn->prepare("SELECT orderNo, accountNo, destination, receiversName, status, pickUp, orderDate FROM orders WHERE accountNo = 1;");
			// use exec() because no results are returned
			$sql->execute();
		}
	catch(PDOException $e)
		{
			echo $sql . "<br>" . $e->getMessage();
		}

	$result = $sql->fetchAll();
	print_r($result->num_rows);
	if (isset($result)) {
		 // output data of each row
		foreach($result as $row) {
		
		if($_SESSION['accountNo'] == $row['accountNo']) { ?>

		<div class="horizontal-center">
		<div class="row">
		<div class="col-md-30">
			<div class="panel-group">
			  <div class="panel panel-primary">
			  <div class="panel-heading">Order #<?php echo $row['orderNo']; ?></div>
			  <div class="panel-body">Sent To: <?php echo $row['receiversName']; ?><br>
			  Destination: <?php echo $row['destination']; ?><br>
			  Sent From: <?php echo $row['pickUp']; ?><br>
			  Status: <?php echo $row['status']; ?><br>
			  Estimated Delivery: <?php 
			  $date = new DateTime($row['orderDate']);
			  date_add($date, date_interval_create_from_date_string('5 weekdays'));
			  echo $date->format('d/m/Y'); ?></div>
			  </div>
			  </div>
			  </div>
			  </div>
		 <?php }
		 }
	} else {
		 echo "0 results";
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