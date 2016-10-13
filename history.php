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
    <body>
	<?php
        include 'navbar.php';
	?>
        
    <div class="horizontal-center">
	<h2 class="text-center">Order History</h2>
		<?php
            include 'database.php';
            $db = new database;
            $db->connectToDatabase();
            $sqlSt = "SELECT orderNo, accountNo, destination, receiversName, status, pickUp, orderDate, estimatedDelivery, priority FROM orders WHERE accountNo = ".$_SESSION["accountNo"].";";
            $result = $db->getArrayOfValues($sqlSt);
            if (isset($result)) {
                foreach($result as $row){
					if ($row['status'] != 'Cancelled') {?>
                        <div class="row">
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
											Priority: <?php
											switch ($row['priority']) {
												case 1:
													echo "Overnight";
													break;
												case 2:
													echo "Express";
													break;
												case 3:
													echo "Standard";
													break;
											} ?><br>
                                            Estimated Delivery: <?php 
											$date = date_create($row['estimatedDelivery']);
											echo date_format($date, "d/m/Y");?>
                                        </div>
										<?php
											if ($row['status'] = 'Pending') {
										?>
										<form action = "markCancelled.php" method="post" name="statusMarker">
                                            <div class="btn-container-right">
                                                <button type="submit" name="statusCancel" value=<?php echo $row['orderNo']; ?> class="btn btn-danger btn-space">Cancel Order</button>				
                                            </div>
                                        </form>
										<?php
											}
										?>
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