<!DOCTYPE html>
<html>
    <?php
        include "head.php"
    ?>
    <body>
        <?php
            include 'selectNav.php';
            include 'database.php';
            include 'PHPfunctions.php';
            $db = new database;
            $db->connectToDatabase();
            $sqlSt = "SELECT orderNo, accountNo, destination, status, pickUp, orderDate FROM orders WHERE status = 'Pending';";
            $result = $db->getArrayOfValues($sqlSt);
            if (isset($result)) {
                foreach($result as $row){?>
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