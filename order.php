<!DOCTYPE html>
<html lang="en">
  <?php
    session_start();
    if($_SESSION["login"] !=true){
        header("Location:index.php");
    }
    include "head.php";
  ?>

  <body>

	<?php
            include 'selectNav.php';
        ?>

	<div class="row top30">
	<div class="center-block col-md-4 " style="float: none; background-color:#eee">
	<form method="POST" action="orderConfirmation.php">
	  <div class="form-group">
		<label for="destination">Destination:</label>
		<input type="text" class="form-control" id="destination" name="destination" placeholder="Sending To">
	  </div>
	  <div class="form-group">
		<label for="pickup">Pick Up:</label>
		<input type="text" class="form-control" id="pickup" name="pickup" placeholder="Sending From">
	  </div>
	  <div class="form-group">
		<label for="receiversname">Receiver's Name:</label>
		<input type="text" class="form-control" id="receiversname" name="receiversname" placeholder="Receiver's Name">
	  </div>
	  <div class="form-group">
		<label for="receiverscontact">Receiver's Contact Number:</label>
		<input type="tel" class="form-control" id="receiverscontact" name="receiverscontact" placeholder="Receiver's Contact Number">
	  </div>	  
	  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
	  
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
