<!-- Author: J. Keith Owens
File Name: lab2.php
Created Date: 9/14/2018
Purpose: A sample registration page using PHP Post method (lab2 of n242)
File also sends a registration email and activation code
This file contains the user interface
Revision History:
JKO 9/4/2018 Original Build
JKO 9/14/2018 Made password field a password type (from text type)
              added functions file as a dependency
-->

<?php
session_start();

 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Registration Form</title>

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
	require_once "functions.php";
	require_once "mail/mail.class.php";
  include "RegistrationFormPHP.php"
?>

          <div class="container containerinput" style="margin-top:75px">
            <!-- Feedback Form Starts Here -->
            <div id="feedback">
            <!-- Heading Of The Form -->
            <div class="head">
              <p>
                Please fill out all fields.  Thanks!
              </p>
              <?php print "<h2>".$message."</h2>"; ?>


              <!-- Feedback Form Ends Here -->

                <form action="lab4.php" id="form" method="post" name="form">

                <?php print $firstBlank;?><input name="vFirstName" placeholder="First Name" type="text" value="">

                <?php print $lastBlank;?><input name="vLastName" placeholder="Last Name" type="text" value="">
                <?php print $validateBlank;?>
                <?php print $matchEmail;?>
                <?php print $emailBlank;?><input name="vEmail" placeholder="Your Email" type="text" value="">

                <?php print $confirmEmailBlank;?><input name="vConfirmEmail" placeholder="Confirm Your Email" type="text" value="">
                <?php print $matchBlank;?>
                <?php print $passwordBlank;?><input name="vPassword" placeholder="Enter Password" type="password" value="">
                <?php print $validatePassword;?>
                <?php print $confirmPasswordBlank;?><input name="vConfirmPassword" placeholder="Confirm Your Password" type="password" value="">

                <label for "gender">Gender</label> <br />
                <input id="gender" type="radio" name="vGender" value="male" checked="checked"> Male<br>
                <input id="gender" type="radio" name="vGender" value="female"> Female<br>
                <br />
                <label for "department">Department</label>
                <select id="department" name="vDepartment">
                  <option value="Computer" selected="selected">Computer</option>
                  <option value="Library">Library</option>
                  <option value="Science">Science</option>
                </select>

                <?php print $statusBlank;?>
                <input type="checkbox" name="vStatus" value="student"> Student<br>
                <input type="checkbox" name="vStatus" value="faculity"> Faculity<br>
                <input type="checkbox" name="vStatus" value="staff"> Staff<br>
                <input type="checkbox" id="agreeToTerms" name="vAgreeToTerms" value="agree">
                <label for="agreeToTerms">Agree to Terms?</label> <?php print $agreeBlank;?>
                <br />
                <input id="send" name="submit" type="submit" value="Submit">
                </form>
            </div>
            <!-- Feedback Form Ends Here -->

            </div>

        </div>



  </body>
</html>
