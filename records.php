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
            $sqlSt = "SELECT orderNo, accountNo, destination, status, pickUp, orderDate FROM orders ORDER BY orderNo DESC;";
            $result = $db->getArrayOfValues($sqlSt);
            if (isset($result)) {
				 ?>
					<div class="container">
                        <div class="row" style="margin-top:25px">
							<div class="col-md-8 col-md-offset-2">
								<table class="table table-hover table-striped">	
									<thead>
										<tr>
											<th>Order</th>
											<th>Customer</th>
											<th>Order Date</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
									<?php 
									for ($i = count($result) - 1; $i >= 0; $i--) { 
									$row = $result[$i];?>									
									<tr class='clickable-row' data-href="orderDetails.php?order=<?php echo $row['orderNo']; ?>">
										<td>#<?php echo $row['orderNo']; ?></td>
										<td>#<?php echo $row['accountNo']; ?></td>
										<td><?php 
                                            $date = new DateTime($row['orderDate']);
                                            echo $date->format('d/m/Y'); ?></td>
										<td><?php echo $row['status']; ?></td>
									</tr>
									<?php } ?>  
									</tbody>
								</table>
							</div>
						</div>
					</div>
                 <?php 
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