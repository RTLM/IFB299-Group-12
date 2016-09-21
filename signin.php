<!DOCTYPE html>
<html lang="en">
  <html lang="en">
  <?php
	include 'head.php';
  ?>
  <body>
	<?php
		include 'selectNav.php';
    ?>

    <div class="container">

      <form class="form-signin" name="loginForm" action="loginPage.php" method="post">
        <h2 class="form-signin-heading">Please Sign In</h2>
        <label for="email" class="sr-only">Email address</label>
        <input type="email" name="email" class="form-control" placeholder="Email Address" required autofocus>
        <label for="password" class="sr-only">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
