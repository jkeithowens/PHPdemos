<!-- Author: J. Keith Owens
File Name: Output.php
Created Date: 9/4/2018
Purpose: A sample registration page using PHP Post method (lab1 of n242)
This file shows a message if an email was successfully sent
Revision History:
JKO 9/4/2018 Original Build
JKO 9/14/2018 Added file name
JKO 10/9/18 Added output that displays the users' data using a session variable
 No revision -->

<?php
//must include UserConstructor.php or object won't load
include "UserConstructor.php";
//starts session
session_start();

//prints object, only to help with debugging and grading
//print_r($_SESSION['userInfo']);
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Sample Registration Form</title>

    <!-- Bootstrap & Jquery scripts-->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Stylesheet link -->
    <link href="style.css" rel="stylesheet">

  </head>

  <body class ="bodybackground">
    <!-- Get request that gets message (either success or fail) -->
 <!--changed GET request to session variable -->

<?php 
//$msg = $_GET['msg']
$msg = $_SESSION['message']?>
          <div class="container containerinput" style="margin-top:75px">
            <!-- Feedback Form Starts Here -->
            <div id="feedback">
            <!-- Heading Of The Form -->
              <div class="head">
                  <!-- thank you for registering message -->
                <?php print "<h2>".$msg."</h2>"; ?>

                  <!-- uses $userObject assigned from session variable $_SESSION['userInfo'] to print session variables-->
                <?php print "<h4> Your First Name: ".($_SESSION['userInfo']->GetFirstName())."</h1>"; ?>
                <?php print "<h4> Your Last Name: ".($_SESSION['userInfo']->GetLastName())."</h1>"; ?>
                <?php print "<h4> Your User Name: ".($_SESSION['userInfo']->email)."</h1>"; ?>
                <?php print "<h4> Your password: ".($_SESSION['userInfo']->password)."</h1>"; ?>
                <?php print "<h4> Your gender: ".($_SESSION['userInfo']->gender)."</h1>"; ?>
                <?php print "<h4> Your department: ".($_SESSION['userInfo']->department)."</h1>"; ?>
                <?php print "<h4> Your status: ".($_SESSION['userInfo']->status)."</h1>"; ?>
                <?php print "<h4> Your activation code: ".($_SESSION['userInfo']->code)."</h1>"; ?>

              </div>
            </div>
        </div>



  </body>
</html>
