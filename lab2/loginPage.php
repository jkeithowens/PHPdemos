<!-- Author: J. Keith Owens
File Name: loginPage.php
Created Date: 9/4/2018
Purpose: A sample registration page using PHP Post method (lab1 of n242)
This file makes sure the activation code is valid and has a login field
JKO 9/4/2018 Original Build
-->


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login Page</title>

    <!-- Bootstrap & Jquery scripts-->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Stylesheet link -->
    <link href="style.css" rel="stylesheet">

  </head>

  <body class ="bodybackground">
<?php

//calls dependencies
require_once "functions.php";
require_once "RegistrationFormPHP.php";

//GET request that captures the activation code as variable "a"
$activationCode = "";
if(isset($_GET['a']))	{
  $activationCode = $_GET['a'];
}
$activationMessage = ""; //sets initial activation message to empty

//calls function to make sure code is 50 digits and alphanumeric
if (codeValidate($activationCode)==true) {
  //displays message showing successful activation
$activationMessage = "activation successful";
}
else {
//displays message showing failed activation
$activationMessage = "activation failed";
}



?>
            <!-- Form for login Starts Here -->
        <div class="container containerinput" style="margin-top:75px">
          <div>
          <!-- Heading Of The Form -->
            <H1>Login:</H1>
            <?php print $activationMessage;?>
              <form action="#" id="form" method="post" name="form">
                <!-- Form contains a field for login and password -->
              <?php print $emailBlank . $validateBlank;?><input name="vEmail" placeholder="Your Email" type="text" value="">
              <?php print $passwordBlank;?><input name="vPassword" placeholder="Enter Password" type="password" value="">
              <br />
              <input id="send" name="submit" type="submit" value="Submit">
            </form>
          </div>
        </div>

  </body>
</html>
