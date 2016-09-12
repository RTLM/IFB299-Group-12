

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
	include('navbar.php');
	?>

	<div class="row top30">
	<div class="center-block col-md-4 " style="float: none; background-color:#eee">
	<form method="POST" action="addUser.php">
	
	  <div class="form-group">
		<label for="email">Email Address:</label>
		<input type="email" class="form-control" id="email" name="email" placeholder="Email">
	  </div>
	  <div class="form-group">
		<label for="contact">Contact Number:</label>
		<input type="tel" class="form-control" id="contact" name="contact" placeholder="Contact Phone Number">
	  </div>
	  <div class="form-group">
		<label for="address">Address:</label>
		<input type="text" class="form-control" id="address" name="address" placeholder="Home/Work Address">
	  </div>
	  <div class="form-group">
		<label for="firstname">First Name:</label>
		<input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name">
	  </div>
	  <div class="form-group">
		<label for="lastname">Last Name:</label>
		<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">
	  </div>	  
	  <button id="submit" name="submit" type="submit" value="Add Customer" class="btn btn-primary">Submit</button>
	  
	</form>
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




