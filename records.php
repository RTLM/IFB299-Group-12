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
            $sqlSt = "SELECT orderNo, accountNo, destination, status, pickUp, orderDate FROM orders;";
            $result = $db->getArrayOfValues($sqlSt);
            if (isset($result)) {
				for ($i = count($result) - 1; $i >= 0; $i--) { 
				$row = $result[$i]; ?>
                    <div class="horizontal-center">
                        <div class="row">
                            <div class="col-md-30"style="margin-top:50px">
                                <div class="panel-group">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            Order #<?php echo $row['orderNo']; ?>
                                        </div>
                                        <div class="panel-body"> 
											Customer: #<?php echo $row['accountNo']; ?><br>
											Order Date: <?php 
                                            $date = new DateTime($row['orderDate']);
                                            echo $date->format('d/m/Y'); ?><br>                                          
                                            Status: <?php echo $row['status']; ?><br>
                                        </div>
                                            <div class="btn-container-right">
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