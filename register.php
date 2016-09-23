<?php
    session_start();
    if($_SESSION["login"] == true){
        header("Location:index.php");
        exit;
    }
    include 'database.php';
    if(isset($_POST['email'])) {
        $emailId = htmlspecialchars($_POST['email']);
        $contact = htmlspecialchars($_POST['contact']);
        $address = htmlspecialchars($_POST['address']);
        $firstName = htmlspecialchars($_POST['firstname']);
        $lastName = htmlspecialchars($_POST['lastname']);
        $password = htmlspecialchars($_POST['password']);
        $accountType = 'Customer';
        $db = new database;
        $db->connectToDatabase();
        if($db->makeAccount($emailId, $address, $contactNumber, $firstName, $lastName, $password, $accountType) ==false)
        {
          global $error;
          $error = true;
        }
        else{
            //Log in the user..
            $userDetails = $db->checkCredentials($emailId, $password);
            $_SESSION["login"] = true;
            $_SESSION["emailId"] = $userDetails["emailId"];
            $_SESSION["accountNo"] = $userDetails["accountNo"];
            $_SESSION["accountType"] = $userDetails["accountType"];
            header("Location:index.php");
            exit;
        }      
}//end if
?>
<!DOCTYPE html>

<html lang="en">
  <?php
    include 'head.php';
  ?>
  <body>
	<?php
	include('navbar.php');
	?>
	<div class="container">
	<h2 class="text-center">Register Account</h2>
            <div class="col-md-8 col-md-offset-2" style="float: none; background-color:#eee">
                <form method="POST" action="register.php">
                    <?php if($error){echo"<label style='color:red'>Email Address Used!!!</label>";}?>
                    <div class="form-group">
                          <label for="email">Email Address:</label>
                          <input <?php if($error){echo"value='$emailId'";}?>type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                          <label for="password">Password:</label>
                          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                          <label for="contact">Contact Number:</label>
                          <input <?php if($error){echo"value='$contact'";}?>type="tel" class="form-control" id="contact" name="contact" placeholder="Contact Phone Number">
                    </div>
                    <div class="form-group">
                          <label for="address">Address:</label>
                          <input <?php if($error){echo"value='$address'";}?>type="text" class="form-control" id="address" name="address" placeholder="Home/Work Address">
                    </div>
                    <div class="form-group">
                          <label for="firstname">First Name:</label>
                          <input <?php if($error){echo"value='$firstName'";}?>type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name">
                    </div>
                    <div class="form-group">
                          <label for="lastname">Last Name:</label>
                          <input <?php if($error){echo"value='$lastName'";}?>type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">
                    </div>	  
                    <button id="submit" name="submit" type="submit" value="Add Customer" class="btn btn-primary">Submit</button>

                </form>
            </div>
	</div>
      <?php
        include "tail.php";
      ?>
  </body>
</html>