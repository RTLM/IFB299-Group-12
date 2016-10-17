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
            $sqlSt = "SELECT orderNo, drivers.accountNo, destination, status, pickUp, orderDate, driver, estimatedDelivery 
						FROM orders 
						JOIN drivers ON orders.driver = drivers.driverNo 
						WHERE drivers.accountNo = ".$_SESSION["accountNo"]." AND status NOT IN ('Cancelled', 'Complete')
						ORDER BY estimatedDelivery ASC;";
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
														<th>Pick-Up From</th>
															<td class="col-md-6"><?php echo $row['pickUp']; ?></td>
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
														<th>Delivery Target</th>
															<td><?php $date = new DateTime($row['estimatedDelivery']);
																echo $date->format('d/m/Y'); ?></td>
													</tr>
												</tbody>
											</table>
											<form id = <?php echo '"form'."$formId".'"'; ?> action = "assignDriver.php" method="post">		 
												<div class="pull-right">
													<div class="dropdown div-inline">
														<button class="btn btn-primary btn-space dropdown dropdown-toggle" type="button" data-toggle="dropdown">Update Status
    													<span class="caret"></span>
    												</button>
    												<ul class="btn-space dropdown-menu">
    													<li><a onclick="submitForm(<?php echo $formId; ?>,'Ready For Pickup', 'status')">Ready for Pickup</a></li>
    													<li><a onclick="submitForm(<?php echo $formId; ?>,'On Way to Warehouse', 'status')">On Way to Warehouse</a></li>
    													<li><a onclick="submitForm(<?php echo $formId; ?>,'At Warehouse', 'status')">At Warehouse</a></li>
    													<li><a onclick="submitForm(<?php echo $formId; ?>,'With Driver For Delivery', 'status')">With Driver For Delivery</a></li>
    													<li><a onclick="submitForm(<?php echo $formId; ?>,'Complete', 'status')">Complete</a></li>
												    </ul>
                                                    <input id = <?php echo '"status'."$formId".'"'; ?> type="hidden" value="RFP" name = "status">
                                                    <input type = "hidden" value = <?php echo '"'.$row["orderNo"].'"';?> name = "orderNumber">
														<a href="orderDetails.php?order=<?php echo $row['orderNo']; ?>" class="btn btn-info btn-space" name role="button">Order Details</a>
													</div>
												</div>
											</form>											
										</div>
                                    </div>
                                </div>
							</div>
                        </div>
					</div>
                 <?php
                 $formId++;
                }//end forEach
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