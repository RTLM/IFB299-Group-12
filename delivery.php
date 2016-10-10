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
            $sqlSt = "SELECT orderNo, accountNo, destination, status, pickUp, orderDate, estimatedDelivery, priority FROM orders WHERE status NOT IN ('Complete', 'Cancelled') ORDER BY estimatedDelivery, priority;";
            $result = $db->getArrayOfValues($sqlSt);
            if (isset($result)) {
                foreach($result as $row){ ?>
                    <div class="horizontal-center">
                        <div class="row">
                            <div class="col-md-30"style="margin-top:50px">
                                <div class="panel-group">
                                    <div class="panel panel-<?php $deliveryDate = new DateTime($row['estimatedDelivery']); echo statusOfDeliveryForDriver($deliveryDate, $row["status"])?>">
                                        <div class="panel-heading">
                                            Order #<?php echo $row['orderNo']; ?>
                                        </div>
                                        <div class="panel-body"> 
                                            Pick-Up From: <?php echo $row['pickUp']; ?><br>
                                            Destination: <?php echo $row['destination']; ?><br>                                            
                                            Estimated Delivery: <?php 
											$date = date_create($row['estimatedDelivery']);
											echo date_format($date, "d/m/Y");?><br>
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
												}?><br>
											Status: <?php echo $row['status']; ?>
                                        </div>
                                        <form action = "markComplete.php" method="post" name="statusMarker">
                                            <div class="btn-container-right">
                                                <button type="submit" name="statusComplete" value=<?php echo $row['orderNo']; ?> class="btn btn-success btn-space">Mark As Complete</button>
                                                <a href="orderDetails.php?order=<?php echo $row['orderNo']; ?>" class="btn btn-info btn-space" name role="button">Order Details</a>					
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
                 <?php
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