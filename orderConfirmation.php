<!DOCTYPE html>
<html lang="en">
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

  </head>

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
		<p class="form-control-static"><?php echo $_POST['email']; ?></p>
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
	  <a href="order.php" class="btn btn-danger" role="button">Cancel</a>
	  
	</form>
	</div>
	</div>
	
</div>

    <hr>

      <footer>
        <p>&copy; 2016 On The Spot, Inc.</p>
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