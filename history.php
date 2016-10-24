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
    <body onload = "clickElement('pending')">
	<?php
        include 'navbar.php';
	?>
        


	<h2 class="text-center">Order History</h2>
	<div class="container">
		<div class="col-md-12 text-center">
			<div class="btn-group">
				<button class="btn btn-primary " type="button" onclick="hideElements(2,this);" style="cursor: pointer;">In Progress</button>
				<button class="btn btn-primary " type="button" onclick="hideElements(1, this);" style="cursor: pointer;">Completed</button>
			</div>
		</div>
	</div>
		<?php
            include 'database.php';
            $db = new database;
            $db->connectToDatabase();
            $sqlSt = "SELECT orderNo, accountNo, destination, receiversName, status, pickUp, orderDate FROM orders WHERE accountNo = ".$_SESSION["accountNo"].";";
            $result = $db->getArrayOfValues($sqlSt);
            if (isset($result)) {
                foreach($result as $row){
					if ($row['status'] != 'Cancelled') {?>
				<div class="container" name = <?php echo '"'.$row['status'].'"' ?>>
					<div class="row" style="margin-top:25px">
						<div class="col-md-6 col-md-offset-3">
							<div class="panel-group">
								<div class="panel panel-primary">
									<div class="panel-heading">
										Order #<?php echo $row['orderNo']; ?>
									</div>
									<div class="panel-body">
										<table class="table table-condensed table-borderless">	
											<tbody>
												<tr>
													<th>Recipient</th>
														<td class="col-md-6"><?php echo $row['receiversName']; ?></td>
												</tr>
												<tr>
												<th>Destination</th>
														<td class="col-md-6"><?php echo $row['destination']; ?></td>
												</tr>
												<tr>
													<th>Status</th>
														<td><?php echo $row['status']; ?></td>
												</tr>
												<tr>
													<th>Estimated Delivery</th>
														<td><?php $date = new DateTime($row['estimatedDelivery']);
															echo $date->format('d/m/Y'); ?></td>
												</tr>
											</tbody>
										</table>
										<div class="pull-right">
											<?php if($row['status'] == "Pending") {?>
											<form class="div-inline" action="markCancelled.php" method="post">
											<div class="form-group">
												<input type="hidden" name="orderNo" value=<?php echo $row['orderNo']; ?> />
											</div>
											<button type="submit" name="submit" class="btn btn-danger btn-space">Cancel Order</button>
											</form>
											<?php } ?>
											<a href="orderDetails.php?order=<?php echo $row['orderNo']; ?>&prev=history" class="btn btn-info btn-space" name role="button">Order Details</a>														
										</div>
									</div>
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

        <?php 
            include "tail.php";
        ?>
    </body>
</html>