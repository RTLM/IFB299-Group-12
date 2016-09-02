<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BDC</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href ="CSS.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=FONTNAME" rel="stylesheet" type="text/css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/wow.min.js"></script>
  </head>
  <body style='background-color:ghostwhite;'>
    <div class='BJwrapperOfMainBody'>
        <div class ='BJheader'>
            <div class='BJheaderFirstElement'>
                <div id = "websiteLogo">On The Spot</div>
            </div>
            <div class="BJheaderHomeButton">
                <div id ="homeButton">
                    Home
                </div>
            </div>    
        </div>
      <!--End of Nav Bar-->
        <!--Start of Left Nav Bar-->
        <?php
        include 'leftNavBar.php';
        ?>
        <!--End of Left Nav bar-->
        <div class="card card-inverse BJmainContainer" style="background-color: #333; border-color: #333;color:white;">
          <div class="card-block">
            <h3 class="card-title">Best Delivery Company</h3>
            <p class="card-text">BDC is the best delivery company in Brisbane.</p>
            <a href="" class="btn btn-primary"style="margin: 2px;">Make Delivery</a>
          </div>
        </div>
        <div class="card card-inverse BJmainContainer" style="background-color: #333; border-color: #333;color:white;margin-left:100px;">
          <div class="card-block">
            <h3 class="card-title">Best Delivery Company</h3>
            <p class="card-text">BDC is based in Brisbane and operate in nearby suburbs.</p>
            <a href="" class="btn btn-primary"style="margin: 2px;">Know More</a>
          </div>
        </div>
      </div>
      <div class='footer'>
      </div>
     </body>
</html>
