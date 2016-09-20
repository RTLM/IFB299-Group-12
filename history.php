<!DOCTYPE html>
<html>
    <?php
        include "head.php"
    ?>
    <body>
        <?php
            include 'selectNav.php';
            include 'database.php';
            $db = new database;
            $db->connectToDatabase();
            $sqlSt = "SELECT orderNo, accountNo, destination, receiversName, status, pickUp, orderDate FROM orders WHERE accountNo = ".$_SESSION["accountNo"].";";
            $result = $db->getArrayOfValues($sqlSt);
            if (isset($result)) {
                foreach($result as $row){?>
                    <div class="horizontal-center">
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
                                            Estimated Delivery: <?php 
                                            $date = new DateTime($row['orderDate']);
                                            date_add($date, date_interval_create_from_date_string('5 weekdays'));
                                            echo $date->format('d/m/Y'); ?>
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
          <footer>
                  <p><?php echo "SELECT orderNo, accountNo, destination, receiversName, status, pickUp, orderDate FROM orders WHERE accountNo = ".$_SESSION["accountNo"].";"?></p>
          </footer>
        </div> <!-- /container -->
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="../../dist/js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>