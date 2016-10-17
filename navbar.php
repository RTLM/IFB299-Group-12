<?php 

session_start();
include 'PHPfunctions.php';

?>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href=<?php 
		switch ($_SESSION["accountType"]) {
			case "Customer":
				echo "index.php";
				break;
			case "Driver":
				echo "assigned.php";
				break;
			case "Owner":
				echo "unassigned.php";
				break;
		}
		?>>On The Spot</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">	  	  
            <ul class="nav navbar-nav">
			<?php 
				echo updateNav($_SESSION['accountType']);
			?>
            </ul>
            <?php if ($_SESSION["login"]){ ?>
			<form class="navbar-form navbar-right">
                <div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $_SESSION["emailId"];?>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
					<?php if ($_SESSION["accountType"] == "Customer"){ ?>
					<li><a href="accountDetails.php">Account Details</a></li>
					<?php } ?>
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