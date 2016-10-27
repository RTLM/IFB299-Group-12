<?php
  session_start();
  global $emailError;
  global $emailLabel;
  global $emailLabelColor;
  $emailError = false;
  $emailLabelColor = "black";
  $emailLabel  = "Email:";
  
  global $passwordError;
  global $passwordLabel;
  global $passwordLabelColor;
  $passwordLabel = "Password:";
  $passwordLabelColor = "Black";
  
  global $firstNameError;
  global $firstNameLabelColor;
  global $firstNameLabel;
  $firstNameLabel = "Name:";
  $firstNameLabelColor = "Black";

  global $lastNameError;
  global $lastNameLabelColor;
  global $lastNameLabel;
  $lastNameLabel = "Last Name:";
  $lastNameLabelColor = "Black";

  global $contactError;
  global $contactLabel;
  global $contactLabelColor;
  $contactLabel = "Contact:";
  $contactLabelColor = "Black";

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
      if($db->checkIfEmailIdUsed($emailId) == false && $db->invalidate($emailId,"email") == false){
        if($db->invalidate($password,"password") == false && $db->invalidate($firstName,"name") == false && $db->invalidate($lastName,"name") == false && $db->invalidate($contact,"number") == false){

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
        }
        else {
          if($db->invalidate($password,"password")){
            $passwordError = true;
            $passwordLabel = "Should be 8 characters long and contain one capital and Numeric char.";
            $passwordLabelColor = "red";
          }
          if($db->invalidate($firstName,"name")){
            $firstNameError = true;
            $firstNameLabel = "Invalid Name:";
            $firstNameLabelColor = "red";
          }
          if($db->invalidate($lastName,"name")){
            $lastNameError = true;
            $lastNameLabel = "Invalid Last Name:";
            $lastNameLabelColor = "red";
          }
          if($db->invalidate($contact,"number")){
            $contactLabel = "Provide Australian Number";
            $contactError = true;
            $contactLabelColor = "red";
          }
        }    
      }
      else{
        $emailError = true;
        $emailLabelColor = "red";
        if($db->checkIfEmailIdUsed($emailId)){
          $emailLabel = "Email Used";
        }
        else if($db->invalidateEmail($emailId)){
          $emailLabel = "Invalid Email:";
        }
      }
}//end if
?>
<!DOCTYPE html>

<html lang="en">
  <?php
    include 'head.php';
  ?>
  <body onload="prepareRegister();">
	<?php
	include('navbar.php');
	?>
	<div class="container">
	<h2 class="text-center">Register Account</h2>
            <div class="col-md-8 col-md-offset-2" style="float: none; background-color:#eee">
                <form method="POST" onsubmit = "return validateRegisterForm()" action="register.php">
                    <div class="form-group">
                          <label for="email" style = "color:<?php echo $emailLabelColor; ?>"><?php echo $emailLabel;?></label>
                          <input <?php if($error){echo"value='$emailId'";}?>type="email" class="form-control" id="email" name="email" placeholder="Email" onkeydown="validate('email','email',false);" autocomplete = "off" value = <?php echo $emailId; ?>>
                    </div>
                    <div class="form-group">
                          <label for="password" style = "color:<?php echo $passwordLabelColor; ?>"><?php echo $passwordLabel; ?></label>
                          <input type="password" class="form-control" id="password" name="password" placeholder="Password" onkeydown="validate('password','password',false);">
                    </div>
                    <div class="form-group">
                          <label for="contact"style = "color:<?php echo $contactLabelColor; ?>"><?php echo $contactLabel;?></label>
                          <input <?php if($error){echo"value='$contact'";}?>type="tel" class="form-control" id="contact" name="contact" placeholder="Contact Phone Number" onkeydown="validate('contact','number',false);" autocomplete = "off" value = <?php echo $contact; ?>>
                    </div>
                    <div class="form-group">
                          <label for="address">Address:</label>
                          <input <?php if($error){echo"value='$address'";}?>type="text" class="form-control" id="address" name="address" placeholder="Home/Work Address" onchange="doGeocode('address');validateAddresses('address');" autocomplete="off" value = <?php echo $address; ?>>
                    </div>
                    <div class="form-group">
                          <label for="firstname" style = "color:<?php echo $firstNameLabelColor; ?>"><?php echo $firstNameLabel;?></label>
                          <input <?php if($error){echo"value='$firstName'";}?>type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" onkeydown="validate('firstname','name',false);" autocomplete="off" value = <?php echo $firstName; ?>>
                    </div>
                    <div class="form-group">
                          <label for="lastname"style = "color:<?php echo $lastNameLabelColor; ?>"><?php echo $lastNameLabel;?></label>
                          <input <?php if($error){echo"value='$lastName'";}?>type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" onkeydown="validate('lastname','name',false);" autocomplete="off" value = <?php echo $lastName; ?>>
                    </div>	  
                    <button id="submit" name="submit" type="submit" value="Add Customer" class="btn btn-primary">Submit</button>
                </form>
                <div style="display: none;" id = "addressDiv">
                </div>  
            </div>
	</div>
      <?php
        include "tail.php";
      ?>
  </body>
</html>