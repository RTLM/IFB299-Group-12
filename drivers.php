<?php
    session_start();
    if($_SESSION["login"]==true && ($_SESSION["accountType"]=="Owner")){
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
            $sqlSt = "SELECT * FROM drivers ORDER BY driverNo DESC;";
            $result = $db->getArrayOfValues($sqlSt);
            if (isset($result)) {
                $formId = 0; ?>
                    <div class="container">
                        <div class="row" style="margin-top:25px">
							<div class="col-md-8 col-md-offset-2">
								<table class="table table-hover table-striped">	
									<thead>
										<tr>
											<th>Driver ID</th>
											<th>Name</th>
											<th>Contact No</th>
										</tr>
									</thead>
									<tbody>
									<?php 
									for ($i = count($result) - 1; $i >= 0; $i--) { 
									$row = $result[$i];?>									
									<tr>
										<td>#<?php echo $row['driverNo']; ?></td>
										<td><?php echo $row['name']; ?></td>
										<td><?php echo $row['contactNo']; ?></td>
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
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="../../dist/js/bootstrap.min.js"></script>
</html>