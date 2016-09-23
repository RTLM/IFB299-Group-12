<?php
    session_start();
    unset($_SESSION["orderSQL"]);
?>
<!DOCTYPE html>
<html lang="en">
  <?php
    include "head.php";
  ?>

  <body>
	<?php
            include 'navbar.php';
            include 'database.php';			
            $db = new database;
            $db->connectToDatabase();
            $sql = ("SELECT orderNo, accountNo, destination, receiversName, status, pickUp, orderDate FROM orders WHERE accountNo = ".$_SESSION["accountNo"].";");
            $getResult = $db->getArrayOfValues($sql);
            $result = $getResult[count($getResult)-1];
        ?>

	<h2 class="text-center">Thank you for your order!</h2>
		<div class="col-md-6 col-md-offset-3" style="float: none; background-color:#eee">
			<div class="text-center">
				<p>Your order has been completed. You can track it in history.</p>
				<p><a class="btn btn-success" href="history.php" role="button">Done</a></p>
			</div>
		</div>	
	</div>
	<?php
        include "tail.php";
    ?>
  </body>
</html>