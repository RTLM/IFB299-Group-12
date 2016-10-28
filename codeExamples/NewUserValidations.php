<?php
  /*This file is self submitting file. It helps user to register with on the spot.
    PHP code helps to validate the inputs.
    @author: Navjot Singh Dhaliwal
  */
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

  global $addressError;
  global $addressLabel;
  global $addressLabelColor;
  $addressLabel = "Address:";
  $addressLabelColor = "Black";



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
        if($db->invalidate($password,"password") == false && $db->invalidate($firstName,"name") == false && $db->invalidate($lastName,"name") == false && $db->invalidate($contact,"number") == false && $db->geocode($address) != false){

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
          if($db->geocode($addres) == false){
            $addressLabel = "Provide valid Address:";
            $addressError = true;
            $addressLabelColor = "red";
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