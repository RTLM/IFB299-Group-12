<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
			<a class="navbar-brand" href="index.php">On The Spot</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
              <li><a href="delivery.php">Deliveries</a></li>
            </ul>
			<form class="navbar-form navbar-right">
				<div class="dropdown">
				  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $_SESSION["emailId"];?>
				  <span class="caret"></span></button>
				  <ul class="dropdown-menu">
					<li><a href="logout.php">Log Out</a></li>
				  </ul>
				</div>
			</form>
		</div><!--/.navbar-collapse -->
	</div>
</nav>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>