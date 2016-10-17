<?php
    session_start();
    if($_SESSION["login"]==true && ($_SESSION["accountType"]=="Owner" || $_SESSION["accountType"]=="Driver")){
    }
    else{
        header("Location:index.php");
    }
?>
<!DOCTYPE html>
<html>
    <?php
        include "head.php"
    ?>
    <body onload ="changeCursorType('pointer','a');">
        <?php
            include 'navbar.php';
            include 'database.php';
            $db = new database;
            $db->connectToDatabase();
            $sqlSt = "SELECT orderNo, accountNo, destination, status, orderDate, driver, receiversName, priority FROM orders WHERE status NOT IN ('Complete', 'Cancelled', 'Pending', 'Ready For Pickup') ;";
            $result = $db->getArrayOfValues($sqlSt);
            if (isset($result)) {
                $formId = 0;
                foreach($result as $row){ ?>
				<div class="container">
                        <div class="row" style="margin-top:25px">
							<div class="col-md-6 col-md-offset-3">
                                <div class="panel-group">
                                    <div class="panel panel-<?php $orderDate = new DateTime($row['orderDate']); echo statusOfDeliveryForDriver($orderDate,$row["status"])?>">
                                        <div class="panel-heading">
                                            Order #<?php echo $row['orderNo']; ?>
                                        </div>
                                        <div class="panel-body">
											<table class="table table-condensed table-borderless">	
												<tbody>
													<tr>
														<th>Driver</th>
															<td class="col-md-6"><?php if (!empty($row['driver'])) {
																echo "#" . $row['driver'];
															} else {
																echo "NO DRIVER ASSIGNED";
															}
															 ?></td>
													</tr>
													<tr>
														<th>Recipient</th>
															<td><?php echo $row['receiversName']; ?></td>
													</tr>
													<tr>
														<th>Destination</th>
															<td><?php echo $row['destination']; ?></td>
													</tr>
													<tr>
														<th>Status</th>
															<td><?php echo $row['status']; ?></td>
													</tr>
													<tr>
														<th>Priority</th>
															<td><?php echo priority($row['priority']); ?></td>
													</tr>
													<tr>
														<th>Estimated Delivery</th>
															<td><?php $date = new DateTime($row['estimatedDelivery']);
																echo $date->format('d/m/Y'); ?></td>
													</tr>
												</tbody>
											</table>
											<div class="pull-right">
												<a href="orderDetails.php?order=<?php echo $row['orderNo']; ?>" class="btn btn-info btn-space" name role="button">Order Details</a>
											</div>
										</div>
                                    </div>
                                </div>
							</div>
                        </div>
					</div>
                 <?php	}//end forEach
            }
            else{
                echo "0 results";
            }
        ?>
        <?php
            include "tail.php";
        ?>
    </body>
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="../../dist/js/bootstrap.min.js"></script>
</html>