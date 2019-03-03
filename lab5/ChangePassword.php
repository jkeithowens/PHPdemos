<!-- Author: J. Keith Owens
File Name: ChangePassword.php
Created Date: 10/15/2018
Purpose: Serves as a page to change password for the registration page labs
JKO 10/15/2018 Original Build
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
session_start();
//calls dependencies
require_once "functions.php";
//require_once "RegistrationFormPHP.php";
require_once "KeithTestDbConnect.php"; //connects to database
require_once "inc/sessionVerify.php"; //makes sure user is logged in
include "header.php"; //navbar

$msg = "";
$uname = "";
$pwd = "";

//variables for input validation
	$message = '';
	$password="";
	$confirmPassword="";
  $validatePassword="";
  $pok = FALSE;
	$cpok = FALSE;
  $match= FALSE;
	$checkPasswordFormat=FALSE;

//variables for messages that display if input not valid
  $oldPasswordBlank="";
	$passwordBlank="";
	$confirmPasswordBlank="";
  $matchBlank="";

?>

<!-- authentication section -->
<?php

  if (isset($_POST['submit']))
  {

    //take the information submitted and verify inputs
    $uname =  trim($_POST['vEmail']);
    $pwd = trim($_POST['vOldPassword']);

    //Security measure 1, always protect password
    //hash the current passwored entered by the user. It should match with the hashed one in database
    //$pwd = sha1($pwd);

    //now veriy the username and password
    if (spamcheck($uname)) //if the email is not a valid format, don't need to continue at all
    {

      /************************************************************************************************************************************
       * The following demonstrates providing an OUT variable to stored the retrieved result from the database.
       * It is a two step process. First, run the stored procedure to store the value in a variable in the database; Second, get the value from the variable.
       * The stored procedure is defined as:
       * Drop procedure if exists SP_COUNT_USER;
       * Create Procedure SP_COUNT_USER(IN uname VARCHAR(50), IN pwd VARCHAR(60))
       * Select count(*) as c from REGISTRATION where username = uname and password = pwd;
       * The SQL injection does not work if the stored procedure is used.
       * */

      //security measure 2: use stored procedures
      $sql = "Call sp_count_user('".$uname."', '".$pwd."');";
      $stmt = $con->query($sql);
      if (!$stmt) {
        $msg = "Username or password incorrect";

      }
      else {
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        $count = $row->c;

        //security measure 3: always use the actual value, don't use $count > 0
        if ($count == 1)
        {
          $sql = "Call SP_FIND_USER_ID1('".$uname."', '".$pwd."')";
          $stmt2 = $con->query($sql);
          $row = $stmt->fetch(PDO::FETCH_OBJ);
          $uid = $row->ID;





          /////section confirms new password

              //checks that password is filled out
              $pok = checkBlank('vPassword');
              if ($pok == TRUE) {
              	$PasswordBlank = '';
              	$password = $_POST['vPassword'];
              } else {
              	$passwordBlank = '<font color="red">*required field</font>';
              }

              //checks that confirm password is filled out
              	$cpok = checkBlank('vConfirmPassword');
              	if ($cpok == TRUE) {
              		$confirmPasswordBlank = '';
              		$confirmPassword = $_POST['vConfirmPassword'];
              	} else {
              		$confirmPasswordBlank = '<font color="red">*required field</font>';
              	}

              //checks that both passwords match
                if($pok==TRUE and $cpok==TRUE) {
                  if($password == $confirmPassword){
                    $match=TRUE;
                  }
                  else {
                    $matchBlank= '<font color="red">*passwords do not match</font>';
                  }
                }

              	//checks to make sure password is 10 characters
              		$checkPasswordFormat = passwordValidate($password);
              		if ($checkPasswordFormat == FALSE) {
              					$validatePassword = '<font color="red">Password does not meet requirements</font><br />';
              		}


              //checks if all fields are filled out, it they are not error messages appear
              	if($checkPasswordFormat==false or $match== FALSE or $pok == FALSE or $cpok == FALSE) {
                }
              	else
              	{
                  //once form has passed all validation a new object is made to hold of the values of the user
              		$msg = "password updated";
                  $pwd = $password;
                  $sql = "Call Update_Password1('".$uname."', '".$pwd."');";
                  print $sql;
                  $stmt = $con->query($sql);
                    $msg= " User authenticated";
                  Header ("Location:Lab5HomePage.php?");
              	}





        }
        else $msg = "The information entered does not match with the records in our database.";
      }

    }
    else $msg = "Please enter a valid email.";


  }

?>




            <!-- Form for login Starts Here -->
        <div class="container containerinput" style="margin-top:75px">
          <div> <!--current login-->
          <!-- Heading Of The Form -->
            <H1>Enter Current Login Info:</H1>

      <?php print $msg;
?>
              <form action="#" id="form" method="post" name="form">
                <!-- Form contains a field for login and password -->
              <?php $oldPasswordBlank?><input name="vEmail" placeholder="Your Email" type="text" value="">
              <?php print $oldPasswordBlank;?><input name="vOldPassword" placeholder="Enter Password" type="password" value="">
              <br />
          </div>


          <div> <!--new login info-->
          <!-- Heading Of The Form -->
            <H1>Enter new password:</H1>

                <!-- Form contains a field for login and password -->
              <?php print $passwordBlank . " " . $validatePassword . " " . $matchBlank?><input name="vPassword" placeholder="Enter Password" type="password" value="">
              <?php print $passwordBlank;?><input name="vConfirmPassword" placeholder="Confirm Password" type="password" value="">
              <br />
              <input id="send" name="submit" type="submit" value="Submit">
            </form>
          </div>

        </div>

  </body>
</html>
