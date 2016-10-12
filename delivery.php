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
    <body>
        <?php
            include 'navbar.php';
            include 'database.php';
            $db = new database;
            $db->connectToDatabase();
            $sqlSt = "SELECT orderNo, accountNo, destination, status, pickUp, orderDate FROM orders WHERE status NOT IN ('Complete', 'Cancelled') ;";
            $result = $db->getArrayOfValues($sqlSt);
            if (isset($result)) {
                $formId = 0;
                foreach($result as $row){ ?>
                    <div class="horizontal-center">
                        <div class="row">
                            <div class="col-md-30"style="margin-top:50px">
                                <div class="panel-group">
                                    <div class="panel panel-<?php $orderDate = new DateTime($row['orderDate']); echo statusOfDeliveryForDriver($orderDate,$row["status"])?>">
                                        <div class="panel-heading">
                                            Order #<?php echo $row['orderNo']; ?>
                                        </div>
                                        <div class="panel-body"> 
                                            Pick-Up From: <?php echo $row['pickUp']; ?><br>
                                            Destination: <?php echo $row['destination']; ?><br>                                            
                                            Status: <?php echo $row['status']; ?><br>
                                            Estimated Delivery: <?php 
                                            $date = new DateTime($row['orderDate']);
                                            date_add($date, date_interval_create_from_date_string('5 weekdays'));
                                            echo $date->format('d/m/Y'); ?>
                                        </div>
                                        <form id = <?php echo '"form'."$formId".'"'; ?> action = "markComplete.php" method="post">		 <div class="btn-container-right">
												<div class="dropdown div-inline">
    												<button class="btn btn-primary btn-space dropdown dropdown-toggle" type="button" data-toggle="dropdown">Update Status
    													<span class="caret"></span>
    												</button>
    												<ul class="btn-space dropdown-menu dropdown-menu-right">
    													<li><a onclick="submitForm(<?php echo $formId; ?>,'Ready For Pickup')">Ready for Pickup</a></li>
    													<li><a onclick="submitForm(<?php echo $formId; ?>,'On Way to Warehouse')">On Way to Warehouse</a></li>
    													<li><a onclick="submitForm(<?php echo $formId; ?>,'At Warehouse')">At Warehouse</a></li>
    													<li><a onclick="submitForm(<?php echo $formId; ?>,'With Driver For Delivery')">With Driver For Delivery</a></li>
    													<li><a onclick="submitForm(<?php echo $formId; ?>,'Complete')">Complete</a></li>
												    </ul>
                                                    <input id = <?php echo '"status'."$formId".'"'; ?> type="hidden" value="RFP" name = "status">
                                                    <input type = "hidden" value = <?php echo '"'.$row["orderNo"].'"';?> name = "orderNumber">
												</div>
                                                <a href="orderDetails.php?order=<?php echo $row['orderNo']; ?>" class="btn btn-info btn-space" name role="button">Order Details</a>							
                                            </div>
                                        </form>
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
