<?php 
session_start();
include 'PHPfunctions.php';

$customer = array(
  'home'  => array('text'=>'Home',  'url'=>'/index.php'),
  'order'  => array('text'=>'Order',  'url'=>'/order.php'),
  'history' => array('text'=>'History', 'url'=>'/history.php'),
  'about' => array('text'=>'About', 'url'=>'/about.php'),
);

$guest = array(
  'home'  => array('text'=>'Home',  'url'=>'/index.php'),
  'about' => array('text'=>'About', 'url'=>'/about.php'),
);


$driver = array(
  'deliveries'  => array('text'=>'Deliveries',  'url'=>'/delivery.php'),
);

$owner = array(
  'deliveries'  => array('text'=>'Deliveries',  'url'=>'/delivery.php'),
  'records'  => array('text'=>'Records',  'url'=>'/records.php'),
);
?>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php">On The Spot</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
	  	  
            <ul class="nav navbar-nav">
			<?php 
			if ($_SESSION["login"]){			
				if ($_SESSION['accountType'] == "Customer") {
					echo updateNav($customer);
				} else if ($_SESSION['accountType'] == "Driver") {
					echo updateNav($driver);
				} else if ($_SESSION['accountType'] == "Owner") {
					echo updateNav($owner);
				}
			} else {
				echo updateNav($guest);
			}
			?>
            </ul>
            <?php if ($_SESSION["login"]){ ?>
			<form class="navbar-form navbar-right">
                <div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $_SESSION["emailId"];?>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a href="logout.php">Log Out</a></li>
                  </ul>
                </div>
            </form>
			<?php } else { ?>
			<form class="navbar-form navbar-right" name="loginForm"action="loginPage.php"method="post">
                <div class="form-group">
                  <input type="text" placeholder="Email" class="form-control"name="email">
                </div>
                <div class="form-group">
                  <input type="password" placeholder="Password" class="form-control"name="password">
                </div>
                <button type="submit" class="btn btn-success"action="submit">Sign in</button>
                <a href="register.php" class="btn btn-primary" role="button">Create Account</a>
            </form>
			<?php } ?>
      </div><!--/.navbar-collapse -->
    </div>
</nav>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>