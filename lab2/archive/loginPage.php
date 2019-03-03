<!-- Author: J. Keith Owens
Created Date: 9/4/2018
Purpose: A sample registration page using PHP Post method (lab1 of n242)
Revision History: No revision -->


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
require_once "util.php";
require_once "RegistrationFormPHP.php";

$activationCode = "";
$activationCode = $_GET['a'];
$activationMessage = "";

if (codeValidate($activationCode)==true) {
$activationMessage = "activation successful";
}
else {
$activationMessage = "activation failed";
}



?>

          <div class="container containerinput" style="margin-top:75px">
            <!-- Feedback Form Starts Here -->
            <div>
            <!-- Heading Of The Form -->
            <H1>Login:</H1>
            <?php print $activationMessage;?>
            <form action="#" id="form" method="post" name="form">
            <?php print $emailBlank . $validateBlank;?><input name="vEmail" placeholder="Your Email" type="text" value="">
            <?php print $passwordBlank;?><input name="vPassword" placeholder="Enter Password" type="password" value="">
            <br />
            <input id="send" name="submit" type="submit" value="Submit">
            </form>

            </div>

        </div>



  </body>
</html>
