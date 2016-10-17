<?php
    session_start();	
	$previous = $_SERVER['HTTP_REFERER'];
	include 'database.php';			
	$db = new database;
	$db->connectToDatabase();
	$sql = ("SELECT orders.accountNo, firstName, lastName, address, orderNo, size, weight, destination, receiversName, driver, receiversContact, status, pickUp, orderDate, contactNo, firstName, lastName, estimatedDelivery, priority, paid, paymentType, valuable FROM orders INNER JOIN customers ON orders.accountNo = customers.accountNo WHERE orderNo=" .$_GET['order'].";");
	$result = $db->getArrayOfValues($sql);
	$row = $result[0];
	if($_SESSION["login"]==true && ($_SESSION["accountType"]=="Owner" || $_SESSION["accountType"]=="Driver")){
		$admin = true;
    } else if ($_SESSION["login"]==true && ($_SESSION["accountNo"]==$row['accountNo'])){
		$admin = false;
	} else {
        header("Location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <?php
        include "head.php";
    ?>
    <body> 
	<?php
		include 'navbar.php';
	?>
		<div class="container">
		<div class="row" style="margin-top:25px">
			<h1 class="text-center">Order #<?php echo $row['orderNo']; ?> </h1>
			<p class="lead">Customer</p>
				<table class="table table-striped">	
					<tbody>
						<tr>
							<th>Account Number</th>
								<td class="col-md-6"><?php echo $row['accountNo']; ?></td>
						</tr>
						<tr>
							<th>Name</th>
								<td><?php echo $row['firstName'] . " " . $row['lastName']; ?></td>
						</tr>
						<tr>
							<th>Contact Number</th>
								<td><?php echo $row['contactNo']; ?></td>
						</tr>
						<tr>
							<th>Address</th>
								<td><?php echo $row['address']; ?></td>
						</tr>
					</tbody>
				</table>
			<p class="lead">Receiver</p>
				<table class="table table-striped">	
					<tbody>	
						<tr>
							<th>Name</th>
								<td class="col-md-6"><?php echo $row['receiversName']; ?></td>
						</tr>
						<tr>
							<th>Contact Number</th>
								<td><?php echo $row['receiversContact']; ?></td>
						</tr>
					</tbody>
				</table>
				<p class="lead">Package Details</p>
				<table class="table table-striped">	
					<tbody>	
						<tr>
							<th>Pick-Up</th>
								<td class="col-md-6"><?php echo $row['pickUp']; ?></td>
						</tr>
						<tr>
							<th>Destination</th>
								<td><?php echo $row['destination']; ?></td>
						</tr>
						<tr>
							<th>Size</th>
								<td><?php 
									if(!empty($row['size'])) { 
										echo $row['size'];
									} else { 
										echo '-' ;}; 
								?></td>
						</tr>
						<tr>
							<th>Weight</th>
								<td><?php 
									if(!empty($row['weight'])) { 
										echo $row['weight'] . ' Kgs';
									} else { 
										echo '-' ;
									}; 
								?></td>
						</tr>							
						<tr>
							<th>Cost</th>
								<td><?php echo '$' . packageCost($row['priority'], $row['size'], $row['weight']); ?></td>
						</tr>
					</tbody>
				</table>
				<p class="lead">Order Details</p>
				<table class="table table-striped">	
					<tbody>	
						<tr>
							<th>Status</th>
								<td class="col-md-6"><?php echo $row['status']; ?></td>
						</tr>
						<tr>
							<th>Priority</th>
								<td><?php
									echo priority($row['priority']); ?>
								</td>
						</tr>
						<tr>
							<th>Valuable</th>
								<td><?php 
								if($row['valuable'] == "TRUE") { 
									echo "Yes";
								} else { 
									echo 'No' ;
								}; ?></td>
						</tr>
						<tr>
							<th>Driver</th>
								<td><?php 
								if(!empty($row['driver'])) { 
									echo $row['driver'];
								} else { 
									echo '-' ;
								}; ?></td>
						</tr>
						<tr>
							<th>Paid</th>
								<td><?php
								if($row['paid'] == "TRUE") { 
									echo "Yes";
								} else { 
									echo 'No' ;
								}; ?></td>
						</tr>
						<tr>
							<th>Payment Type</th>
								<td><?php
								if(!empty($row['paymentType'])) { 
									echo $row['paymentType'];
								} else { 
									echo '-' ;
								}; ?></td>
						</tr>
						<tr>
							<th>Order Date</th>
								<td>
									<?php $date = new DateTime($row['orderDate']);
									echo $date->format('d/m/Y'); ?>
								</td>
						</tr>
						<tr>
							<th>Estimated Delivery</th>
								<td>
									<?php $date = new DateTime($row['estimatedDelivery']);
									echo $date->format('d/m/Y'); ?>
								</td>
						</tr>
					</tbody>
				</table>
			<p align="center">
				<?php if ($admin) { ?>
				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#weightSizeModal">Update Weight and Size</button>
				<?php } ?>
				<a class="btn btn-success" href="<?php echo $previous ?>" role="button">Done</a>
			</p>
		</div>
		</div>			

        <!-- Modal -->
        <div id="weightSizeModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Weight and Size</h4>
                    </div>
                    <div class="modal-body">
                        <form action="updateWeightSize.php" method="post">	
                            <div class="form-group">
                                <label for="weight">Weight (Kgs):</label>
                                <input type="text" class="form-control" id="weight" name="weight" placeholder="Weight e.g. 0.5">
                            </div>
                            <div class="form-group">
                                <label for="size">Package Size:</label>
									<select class="form-control" id="size" name="size">
										<option hidden value="" selected disabled>Select a Size</option>
										<option value="Small">Small</option>
										<option value="Medium">Medium</option>
										<option value="Large">Large</option>
										<option value="X-Large">X-Large</option>
									</select>
                            </div>  
                            <div class="form-group">
                            <input type="hidden" value=<?php echo $row['orderNo']; ?> name="orderNo" />
                            </div> 
                            <div class="modal-footer">
                                <button id="submit" name="submit" type="submit" value="Update Weight-Size" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
	<?php 
		include"tail.php";
	 ?>
  </body>
</html>