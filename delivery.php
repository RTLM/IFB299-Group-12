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
			if ($_SESSION['accountType'] == "Driver") {
				$sqlSt = "SELECT orderNo, drivers.accountNo, destination, status, orderDate, driver, receiversName, priority, estimatedDelivery
							FROM orders 
							JOIN customers ON orders.accountNo = customers.accountNo 
							JOIN drivers ON orders.driver = drivers.driverNo 
							WHERE status NOT IN ('Complete', 'Cancelled', 'Pending', 'Ready For Pickup') AND drivers.accountNo = ".$_SESSION['accountNo']. "
							ORDER BY estimatedDelivery ASC;";
			} else if ($_SESSION['accountType'] == "Owner") {
				$sqlSt = "SELECT orderNo, destination, status, orderDate, driver, receiversName, priority, estimatedDelivery 
							FROM orders 
							JOIN customers ON orders.accountNo = customers.accountNo 
							WHERE status NOT IN ('Complete', 'Cancelled', 'Pending', 'Ready For Pickup') 
							ORDER BY estimatedDelivery ASC;";
            }
            $result = $db->getArrayOfValues($sqlSt);
            if (!empty($result)) {
                $formId = 0;
                foreach($result as $row){ ?>
				<div class="container">
					<div class="row" style="margin-top:25px">
						<div class="col-md-6 col-md-offset-3">
							<div class="panel-group">
								<div class="panel panel-<?php $orderDate = new DateTime($row['estimatedDelivery']); echo statusOfDeliveryForDriver($orderDate)?>">
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
											<a href="orderDetails.php?order=<?php echo $row['orderNo']; ?>&prev=delivery" class="btn btn-info btn-space" name role="button">Order Details</a>
										</div>
									</div>
								</div>
							</div>
						</div>
                    </div>
				</div>
                 <?php	}//end forEach
            } else { ?>
				<div class="container">
					<div class="row" style="margin-top:25px">
						<div class="col-md-6 col-md-offset-3">
							<h1 class="text-center">No Deliveries Available</h1>
						</div>
					</div>
				</div>
           <?php }?>

        <?php
            include "tail.php";
        ?>
    </body>
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="../../dist/js/bootstrap.min.js"></script>
</html>