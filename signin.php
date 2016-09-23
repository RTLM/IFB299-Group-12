<!DOCTYPE html>
<html lang="en">
  <?php
   include 'head.php';
  ?>
  <body>
    <?php
        include 'navbar.php';
    ?>
    <div class="container"style="width:30%;">
      <form class="form-signin" name="loginForm" action="loginPage.php" method="post"style="margin-top:40%;">
        <h2 class="form-signin-heading">Please Sign In</h2>
        <?php 
            if(alertUser($_SESSION["error"],$_SESSION["errorMessage"])){unset($_SESSION["error"]);unset($_SESSION["errorMessage"]);}
        ?>
        <input type="email" name="email" class="form-control" placeholder="Email Address" required autofocus style="margin-bottom:10px;">
        <input type="password" name="password" class="form-control" placeholder="Password" required style="margin-top:10px;">
        <button class="btn btn-lg btn-primary btn-block" type="submit" style="margin-top:10px;">Sign in</button>
      </form>
    </div> <!-- /container -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>