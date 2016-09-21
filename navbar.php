<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php">On The Spot</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li<?php if(htmlspecialchars($_SERVER['PHP_SELF'])=="/PHP/index.php"){echo" class='active'";}?>><a href="index.php">Home</a></li>
                <li><a href="order.php">Order</a></li>
                <li><a href="history.php">History</a></li>
                <li><a href="about.php">About</a></li>
             </ul>
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
      </div><!--/.navbar-collapse -->
    </div>
</nav>