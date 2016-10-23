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
            $sqlSt = "SELECT orderNo, drivers.accountNo, destination, status, pickUp, orderDate, driver, estimatedDelivery, valuable, paid
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
                                    <div class="panel panel-<?php $orderDate = new DateTime($row['estimatedDelivery']); echo statusOfDeliveryForDriver($orderDate)?>">
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
													<tr>
														<th>Signature Required</th>
															<td><?php 
																if($row['valuable'] == "TRUE") { 
																	echo "Yes";
																} else { 
																	echo 'No' ;
																}; ?></td>
													</tr>
												</tbody>
											</table>
											<div class="pull-right">
											<?php if ($row['status'] != "With Driver For Delivery") {?>
												<form class="div-inline" id = <?php echo '"form'."$formId".'"'; ?> action = "updateStatus.php" method="post">														
													<div class="dropdown">
														<button class="btn btn-primary btn-space dropdown dropdown-toggle" type="button" data-toggle="dropdown">Update Status
    													<span class="caret"></span>
    												</button>
    												<ul class="btn-space dropdown-menu">
    													<li><a onclick="updateStatus(<?php echo $formId; ?>,'Ready For Pickup', 'status', <?php echo $row['orderNo']; ?>)">Ready for Pickup</a></li>
    													<li><a onclick="updateStatus(<?php echo $formId; ?>,'On Way to Warehouse', 'status', <?php echo $row['orderNo']; ?>)">On Way to Warehouse</a></li>
    													<li><a onclick="updateStatus(<?php echo $formId; ?>,'At Warehouse', 'status', <?php echo $row['orderNo']; ?>)">At Warehouse</a></li>
    													<li><a onclick="updateStatus(<?php echo $formId; ?>,'With Driver For Delivery', 'status', <?php echo $row['orderNo']; ?>)">With Driver For Delivery</a></li>
												    </ul>
                                                    <input id = <?php echo '"status'."$formId".'"'; ?> type="hidden" value="RFP" name = "status">
													<input type = "hidden" value = <?php echo '"'.$row["orderNo"].'"';?> name = "orderNumber">
													</div>
												</form>
											<?php } else if ($row['status'] == "With Driver For Delivery" && $row['valuable'] == "TRUE") { ?>
												<button type="button" class="btn btn-success btn-space" data-toggle="modal" data-target="#signatureModal" data-order=<?php echo $row['orderNo']; ?>>Order Complete</button>
											<?php } else if ($row['status'] == "With Driver For Delivery") { ?>	
												<form class="div-inline" action="markComplete.php" method="post">
													<div class="form-group">
														<input type="hidden" name="orderNo" value=<?php echo $row['orderNo']; ?> />
													</div>
													<button type="submit" name="submit" class="btn btn-success btn-space">Order Complete</button>
												</form>
											<?php } if ($row['paid'] == "FALSE") { ?>
												<button type="button" class="btn btn-danger btn-space" data-toggle="modal" data-target="#paymentModal" data-order=<?php echo $row['orderNo']; ?>>Payment Details</button>
											<?php } ?>											
												<a href="orderDetails.php?order=<?php echo $row['orderNo']; ?>" class="btn btn-info btn-space" name role="button">Order Details</a>	
											</div>											
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
		
				<!-- Modal -->
        <div id="signatureModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Signature for Valuable Package</h4>
                    </div>
                    <div class="modal-body">
                        <form action="markComplete.php" method="post">	
                            <div class="form-group">
                                <label for="receiver">Receiver's Name:</label>
                                <input type="text" class="form-control" id="receiver" name="receiver" placeholder="Receiver's Name">
                            </div>
                            <div class="form-group">
                            <input type="hidden" name="orderNo" value="" />
                            </div> 
                            <div class="modal-footer">
                                <button id="submit" name="submit" type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
		<script>
		$('#signatureModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget); // Button that triggered the modal
		  var order = button.data('order'); // Extract info from data-* attributes
		  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		  var modal = $(this);
		  modal.find('.modal-title').text('Signature for Valuable Package #' + order);
		  $(event.currentTarget).find('input[name="orderNo"]').val(order);
		})
		</script>
		
			<!-- Modal -->
        <div id="paymentModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Payment for Package</h4>
                    </div>
                    <div class="modal-body">
                        <form action="updatePayment.php" method="post">	
                            <div class="form-group">
                                <label for="paymentType">Payment Type:</label>
                                <input type="text" class="form-control" id="paymentType" name="paymentType" placeholder="Eftpos, Cash, Cheque...">
                            </div>
                            <div class="form-group">
                            <input type="hidden" name="orderNo" value="" />
                            </div> 
                            <div class="modal-footer">
                                <button id="submit" name="submit" type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
		<script>
		$('#paymentModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget); // Button that triggered the modal
		  var order = button.data('order'); // Extract info from data-* attributes
		  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		  var modal = $(this);
		  modal.find('.modal-title').text('Payment for Package #' + order);
		  $(event.currentTarget).find('input[name="orderNo"]').val(order);
		})
		</script>
    </body>
</html>