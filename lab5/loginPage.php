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
session_start();
//calls dependencies
require_once "functions.php";
//require_once "RegistrationFormPHP.php";
require_once "KeithTestDbConnect.php";
include "header.php";
//require_once "dbconnect.php";
$msg = "";
$uname = "";
$pwd = "";
$emailBlank = "";
$passwordBlank = "";
$validateBlank="";
//GET request that captures the activation code as variable "a"
$activationMessage = ""; //sets initial activation message to empty
$activationCode = "";
$email = "";
if(isset($_GET['a']))	{
  $activationCode = $_GET['a'];
  $email = $_GET['e'];

//calls function to make sure code is 50 digits and alphanumeric
	if (codeValidate($activationCode)==true) {
	  //displays message showing successful activation
  $sql = "Call Update_Activate('".$email."');";
  $stmt = $con->query($sql);
  $activationMessage = "activation successful";

	//need to get row that contains $email and then change to active



	}
	else {
	//displays message showing failed activation
	$activationMessage = "activation failed";
	}
}




?>

<!-- authentication section -->
<?php
  if (isset($_POST['submit']))
  {

    $eok = checkBlank('vEmail');
  	if ($eok == TRUE) {
  		$_SESSION['email'] = $_POST['vEmail'];
  	} else {
  		$emailBlank = '<font color="red">*required field</font>';
  	}

    $pok = checkBlank('vPassword');
    if ($pok == TRUE) {
    	$PasswordBlank = '';
    	$password = $_POST['vPassword'];
    } else {
    	$passwordBlank = '<font color="red">*required field</font>';
    }

    //calls emailChecker function to validate email
    	$validate = emailchecker('vEmail');
    	if ($validate == FALSE) {
    		    $validateBlank = '<font color="red">Email not a valid format</font><br />';
    	}

    //take the information submitted and verify inputs
    $uname =  trim($_POST['vEmail']);
    $pwd = trim($_POST['vPassword']);


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
        $stmt->closeCursor();
      }
      else {
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        $count = $row->c;
        $stmt->closeCursor();
        //security measure 3: always use the actual value, don't use $count > 0
        if ($count == 1)
        {
          //not needed
          // $sql = "Call SP_FIND_USER_ID1('".$uname."', '".$pwd."')";
          // echo $sql;
          // $stmt2 = $con->query($sql);
          // $row2 = $stmt2->fetch(PDO::FETCH_OBJ);
          // $uid = $row2->UID;
          // $stmt2->closeCursor();


          $activated ="";
          $stmt1 = $con->prepare("select UserActivated from UserRegistration where UserName = ?");
          $stmt1->execute(array($uname));

          $activated = $stmt1->fetch(PDO::FETCH_ASSOC);
          if ($activated["UserActivated"] =="No") {
            $msg = "User account is not activated, please click on the link in the email sent to you for activation.";
          } else {
            //not needed
            //$_SESSION['uid'] = $uid;
            $_SESSION['email'] = $uname;

            print " User authenticated";
            Header ("Location:Lab5HomePage.php");
          }



        }
        else $msg = "The information entered does not match with the records in our database.";
      }


    }
    else $msg = "Please enter a valid email.";

  }
  else
  {	if (isset($_GET['l'])) //if the user is redirected from the home page
    {
      $tag = $_GET['l'];
      if ($tag == 'r') $msg = "You have already registered with this email. Click on Forget Password to retrieve your password.";

    }
  }

?>




            <!-- Form for login Starts Here -->
        <div class="container containerinput" style="margin-top:75px">
          <div>
          <!-- Heading Of The Form -->
            <H1>Login:</H1>
            <?php print $activationMessage;
			?>
      <?php print $msg;
?>
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
