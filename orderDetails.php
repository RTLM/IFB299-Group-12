<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <?php
        include "head.php";
    ?>
    <body>
        <?php
            include 'navbar.php';
            include 'database.php';			
            $db = new database;
            $db->connectToDatabase();
            $sql = ("SELECT orders.accountNo, orderNo, size, weight, destination, receiversName, receiversContact, status, pickUp, orderDate, contactNo, firstName, lastName FROM orders INNER JOIN customers ON orders.accountNo = customers.accountNo");
            $result = $db->getArrayOfValues($sql);
        ?>
         <h2 class="text-center">Order # <?php echo $result[0]['orderNo']; ?> </h2>    
			<div class="col-md-6 col-md-offset-3" style="float: none; background-color:#eee">
                <div class="text-center">
                    <p>
                        <b>Sending From:</b> <?php echo $result[0]['pickUp']; ?><br>
                        <b>Sending To:</b> <?php echo $result[0]['destination']; ?><br>
                        <b>Size:</b> <?php if(isset($result[0]['size'])) { echo $result[0]['size'] . ' cm';
                        } else { echo '-' ;}; ?><br>
                        <b>Weight:</b> <?php if(isset($result[0]['weight'])) { echo $result[0]['weight'] . ' Kgs';
                        } else { echo '-' ;}; ?><br>
                        <b>Sender:</b> <?php echo $result[0]['firstName'] . ' ' . $result[0]['lastName']; ?><br>
                        <b>Sender's Contact Number:</b> <?php echo $result[0]['contactNo']; ?><br>
                        <b>Receiver:</b> <?php echo $result[0]['receiversName']; ?><br>
                        <b>Receiver's Contact Number:</b> <?php echo $result[0]['receiversContact']; ?><br>
                        <b>Status:</b> <?php echo $result[0]['status']; ?><br>
                        <b>Estimated Delivery:</b><?php 
                        $date = new DateTime($result[0]['orderDate']);
                        date_add($date, date_interval_create_from_date_string('5 weekdays'));
                        echo $date->format('d/m/Y'); ?>
                    </p>
                    <p><button type="button" class="btn btn-info" data-toggle="modal" data-target="#weightSizeModal">Update Weight and Size</button>
                        <a class="btn btn-success" href="delivery.php" role="button">Done</a>
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
                                <label for="size">Size (Cms):</label>
                                <input type="text" class="form-control" id="size" name="size" placeholder="Size e.g. 10x10x10">
                            </div>  
                            <div class="form-group">
                            <input type="hidden" value=<?php echo $result[0]['orderNo']; ?> name="orderNo" />
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
