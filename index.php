<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <?php
	include 'head.php';
  ?>
  <body>
	<?php
			include 'navbar.php';
        ?>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <center><h1>On The Spot Delivery</h1></center>
        <?php
            changeHomePageAccordingUserStatus($_SESSION["login"]); 
        ?>
      </div>
    </div>

   
      <?php
        include "tail.php";
      ?>
  </body>
</html>