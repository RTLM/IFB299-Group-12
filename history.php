<?php
    session_start();
    if($_SESSION["login"]!=true){
        header("Location:signin.php");
        exit;
    }
?>
<!DOCTYPE html>
<html>
    <?php
        include "head.php"
    ?>
    <body onload = "clickElement('completed')">
	<?php
        include 'navbar.php';
	?>
        
    <div class="horizontal-center">
    <input id = "completed" onclick = "hideElements(1);" type="radio" name="vehicle" value="Bike">Completed
    <input id = "pending" onclick = "hideElements(2);" type="radio" name="vehicle" value="Bike">Pending
	<h2 class="text-center">Order History</h2>
		<?php
            include 'database.php';
            $db = new database;
            $db->connectToDatabase();
            $sqlSt = "SELECT orderNo, accountNo, destination, receiversName, status, pickUp, orderDate FROM orders WHERE accountNo = ".$_SESSION["accountNo"].";";
            $result = $db->getArrayOfValues($sqlSt);
            if (isset($result)) {
                foreach($result as $row){
					if ($row['status'] != 'Cancelled') {?>
                        <div name = <?php echo '"'.$row['status'].'"' ?> class="row">
                            <div class="col-md-30">
                                <div class="panel-group">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            Order #<?php echo $row['orderNo']; ?>
                                        </div>
                                        <div class="panel-body">
                                            Sent To: <?php echo $row['receiversName']; ?><br>
                                            Destination: <?php echo $row['destination']; ?><br>
                                            Sent From: <?php echo $row['pickUp']; ?><br>
                                            Status: <?php echo $row['status']; ?><br>
                                            Estimated Delivery: <?php 
                                            $date = new DateTime($row['orderDate']);
                                            date_add($date, date_interval_create_from_date_string('5 weekdays'));
                                            echo $date->format('d/m/Y'); ?>
                                        </div>
										<div class="btn-container-right">
											<form action = "markCancelled.php" method="post" name="statusMarker">
                                                <a href="orderDetails.php?order=<?php echo $row['orderNo']; ?>" class="btn btn-info btn-space" name role="button">Order Details</a>					
												<?php if ($row['status'] == 'Pending') { ?>
												<button type="submit" name="statusCancel" value=<?php echo $row['orderNo']; ?> class="btn btn-danger btn-space">Cancel Order</button>				
												<?php } ?>
											</form>
										</div>						
                                    </div>
                                </div>
                            </div>
                        </div>
                 <?php 
					}
                }//end forEach
            }
            else{
                echo "0 results";
            }
        ?>
		</div>
        <?php 
            include "tail.php";
        ?>
    </body>
</html>