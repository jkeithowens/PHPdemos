<!--
File Name: RegistrationFormPHP.php
Author: J. Keith Owens
Created Date: 9/4/2018
Purpose: A sample registration page using PHP Post method (lab2 of n242)
This file contains the all of the logic for the application (RegistrationForm.php main file)
Revision History:
JKO 9/4/2018 Original Build
JKO 9/14/2018 Added mail() function to email an activation link and code
              Made password field a password type (from text type)
              Added checkBlank() function to check if field were _blank
JKO 10/9/2018 Added session variable functionality and stored user data in an object assigned to session variable
-->


<?php
  include "UserConstructor.php";
	require_once "KeithTestDbConnect.php";
	$message = '';
	$_SESSION['first'] = "";
  $_SESSION['last'] = "";
	$_SESSION['email'] = "";
	$_SESSION['confirmEmail'] = "";
	$password="";
	$confirmPassword="";
	$gender="";
	$department="";
	$status="";
	$agree="";
  $validatePassword="";
  $code;

  $fok = FALSE;
	$lok = FALSE;
  $eok = FALSE;
	$ceok = FALSE;
  $pok = FALSE;
	$cpok = FALSE;
  $sok = FALSE;
  $aok = FALSE;
  $match= FALSE;
  $validate = FALSE;
	$ematchok = FALSE;
	$checkPasswordFormat=FALSE;
  $taken=TRUE;

	$firstBlank="";
	$lastBlank="";
	$emailBlank="";
	$confirmEmailBlank="";
	$passwordBlank="";
	$confirmPasswordBlank="";
	$statusBlank="";
  $agreeBlank="";
  $matchBlank="";
  $validateBlank="";
	$matchEmail = "";
  $takenMsg = "";

	//$_POST is a system array that stores values retrieved through a POST request
if(isset($_POST['submit'])){


//checks that first name is filled out
	$fok = checkBlank('vFirstName');
	if ($fok == TRUE) {
		$_SESSION['first'] = $_POST['vFirstName'];
	} else {
		$firstBlank = '<font color="red">*required field</font>';
	}

//checks that last name is filled out
$lok = checkBlank('vFirstName');
if ($lok == TRUE) {
	$_SESSION['last'] = $_POST['vLastName'];
} else {
	$lastBlank = '<font color="red">*required field</font>';
}

//checks that email is filled out
	// if(isset($_POST['vEmail']))	{
	// 	$email = $_POST['vEmail'];
	// 	if ($email=="")
	// 	{
	// 		$emailBlank = '<font color="red">*required field</font>';
	// 	}
	// 	else $eok = TRUE;
	// }
	$eok = checkBlank('vEmail');
	if ($eok == TRUE) {
		$_SESSION['email'] = $_POST['vEmail'];
	} else {
		$emailBlank = '<font color="red">*required field</font>';
	}

  //checks that confirm email is filled out
	$ceok = checkBlank('vConfirmEmail');
	if ($ceok == TRUE) {
		$_SESSION['confirmEmail'] = $_POST['vConfirmEmail'];
	} else {
		$confirmEmailBlank = '<font color="red">*required field</font>';
	}

  // $taken = checkIfNameExists($_SESSION['email']);
  $sql = "Call sp_count_user_name('".$_SESSION['confirmEmail']."');";
  $stmt = $con->query($sql);
  if (!$stmt) {
    $msg = "error";
  }
  else {
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $row->c;
    if ($count == 1) {
      $taken = TRUE;
    } else {
      $taken= false;
    }
}


	if ($taken == FALSE) {
		$_SESSION['confirmEmail'] = $_POST['vConfirmEmail'];
	} else {
		$takenMsg = '<font color="red">*login already taken</font>';
	}



//if email and confirm email are filled out, makes sure they match
	if($eok==TRUE and $ceok==TRUE) {
    if($_SESSION['email'] ==  $_SESSION['confirmEmail']){
      $ematchok=TRUE;
    }
    else {
      $matchEmail= '<font color="red">*emails do not match</font>';
    }
  }

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
    if($password ==  $confirmPassword){
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


//check if status is blank
	$sok = checkBlank('vStatus');
	if ($sok == TRUE) {
		$status = $_POST['vStatus'];
	} else {
	}

//makes sure agree to terms is checked
  if(isset($_POST['vAgreeToTerms']))	{
		$agree = $_POST['vAgreeToTerms'];
		if ($agree!="agree")
		{
		}
		else $aok = TRUE;
}

//sets department based on drop down selection
  if(isset($_POST['vDepartment']))	{
		$department = $_POST['vDepartment'];
	}

//sets gender based on radio button
  if(isset($_POST['vGender']))	{
    $gender = $_POST['vGender'];
  }

//makse sure you agree to terms (must be checked)
  if ($agree!="agree")
  {
    $agreeBlank = '<font color="red">Must agree to continue</font>';
  }

//makes sure at least one status is checked
  if ($status!="student" and $status!="faculity" and $status!="staff")
  {
    $statusBlank = '<font color="red">Must choose 1 option</font><br />';
  }

//calls emailChecker function to validate email
	$validate = emailchecker('vEmail');
	if ($validate == FALSE) {
		    $validateBlank = '<font color="red">Email not a valid format</font><br />';
	}

//checks if all fields are filled out, it they are not error messages appear
	if($taken == TRUE or $validate==FALSE or $checkPasswordFormat==false or	$ematchok==FALSE or $match== FALSE or $fok==FALSE or $lok==FALSE or $lok == FALSE or $eok == FALSE or $ceok == FALSE or $pok == FALSE or $cpok == FALSE or $sok == FALSE or $aok == FALSE)
		$_SESSION['message'] = "Please enter required fields. ";
	else
	{
    //calls function to generate an alphanumeric code of 50 digits
	  $code = randomCodeGenerator(50);

    // once form has passed all validation a new object is made to hold of the values of the user
		$newUser = new UserInfo($code, $_SESSION['first'], $_SESSION['last'], $password, $_SESSION['email'], $gender, $department, $status);
    //the $newUser object is assigned to a session variable so it can be used in the output form
    $_SESSION['userInfo'] = $newUser;
    $object = $_SESSION['userInfo'];
    $stmt = $con->prepare("insert into UserRegistration values('','$object->email','$object->password','$object->FirstName','$object->LastName','$object->gender','$object->department','$object->status','$object->code','No')");
    $stmt->execute();

    //commented out testing setters in constructor
    // $test="billy";
    //$newUser->setFirstName($test);

		//sets subject line for Mail() function
		$subject = "Email Activation";
		//sets body for Mail() function
		$body = 'Please click on this url to activate your account. <br/>
			 <a href="http://corsair.cs.iupui.edu:23111/lab5/loginPage.php?a='.$newUser->code.'&e='.$_SESSION['email'].'" target="_blank">http://corsair.cs.iupui.edu:23111/lab2/loginPage.php?a='.$newUser->code.'&e='.$_SESSION['email'].'</a>';
//calls mail function to send out the activation email, shows message if successful
		$mailer = new Mail();
		if (($mailer->sendMail($_SESSION['email'], $_SESSION['first'], $subject, $body))==true)
			$_SESSION['message'] = "<b>Thank you for registering. A welcome message has been sent to the address you have just registered.</b>";
//message displays an error if email does not go through
		else $_SESSION['message'] = "Email not sent. " . $_SESSION['email'].' '. $_SESSION['first'].' '. $subject.' '. $body;
		//Header ("Location:Output.php?msg=".$message) ;

    Header("location:Output.php");
	}

}
?>
