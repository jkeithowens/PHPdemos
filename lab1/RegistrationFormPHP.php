<!-- Author: J. Keith Owens
Created Date: 9/4/2018
Purpose: A sample registration page using PHP Post method (lab1 of n242)
Revision History: No revision -->


<?php
	$message = '';

	$first = "";
	$last = "";
	$email = "";
	$confirmEmail="";
	$password="";
	$confirmPassword="";
	$gender="";
	$department="";
	$status="";
	$agree="";

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

	//$_POST is a system array that stores values retrieved through a POST request
	//Notice that values are not sent as query strings
	//Other predefined variables - http://php.net/manual/en/reserved.variables.php
if(isset($_POST['submit'])){

	if(isset($_POST['vFirstName'])) {
		$first = $_POST['vFirstName'];
		if ($first=="")
		{
			$firstBlank = '<font color="red">*required field</font>';
		}
		else $fok = TRUE;
	}

	if(isset($_POST['vLastName'])) {
		$last = $_POST['vLastName'];
		if ($last=="")
		{
			$lastBlank = '<font color="red">*required field</font>';
		}
		else $lok = TRUE;
	}

	if(isset($_POST['vEmail']))	{
		$email = $_POST['vEmail'];
		if ($email=="")
		{
			$emailBlank = '<font color="red">*required field</font>';
		}
		else $eok = TRUE;
	}

	if(isset($_POST['vConfirmEmail']))	{
		$confirmEmail = $_POST['vConfirmEmail'];
		if ($confirmEmail=="")
		{
			$confirmEmailBlank = '<font color="red">*required field</font>';
		}
		else $ceok = TRUE;
	}

	if(isset($_POST['vPassword']))	{
		$password = $_POST['vPassword'];
		if ($password=="")
		{
			$passwordBlank = '<font color="red">*required field</font>';
		}
		else $pok = TRUE;
	}

	if(isset($_POST['vConfirmPassword']))	{
		$confirmPassword = $_POST['vConfirmPassword'];
		if ($confirmPassword=="")
		{
			$confirmPasswordBlank = '<font color="red">*required field</font>';
		}
		else $cpok = TRUE;
	}

  if($pok==TRUE and $cpok==TRUE) {
    if($password ==  $confirmPassword){
      $match=TRUE;
    }
    else {
      $matchBlank= '<font color="red">*passwords do not match</font>';
    }
  }

  if(isset($_POST['vStatus']))	{
		$status = $_POST['vStatus'];
		if ($status=="")
		{
			// $statusBlank = '<font color="red">*Must choose at least 1 option</font>';
		}
		else $sok = TRUE;
	}

  if(isset($_POST['vAgreeToTerms']))	{
		$agree = $_POST['vAgreeToTerms'];
		if ($agree!="agree")
		{

		}
		else $aok = TRUE;
}


  if(isset($_POST['vDepartment']))	{
		$department = $_POST['vDepartment'];
	}

  if(isset($_POST['vGender']))	{
    $gender = $_POST['vGender'];
  }

  if ($agree!="agree")
  {
    $agreeBlank = '<font color="red">Must agree to continue</font>';
  }

  if ($status!="student" and $status!="faculity" and $status!="staff")
  {
    $statusBlank = '<font color="red">Must choose 1 option</font><br />';
  }

  $email= filter_var($email, FILTER_VALIDATE_EMAIL);
  if (!$email){
  $validateBlank = '<font color="red">Email not a valid format</font><br />';
} else {
  $validate = TRUE;
}

	if($validate==FALSE or $match== FALSE or $fok==FALSE or $lok==FALSE or $lok == FALSE or $eok == FALSE or $ceok == FALSE or $pok == FALSE or $cpok == FALSE or $sok == FALSE or $aok == FALSE)
		$message = "Please enter required fields. ";
	else
	{

		//htmlspecialchars($string) converts certain HTML special characters(&, ', ", <, and >) to their corresponding HTML entities and returns the resulting string.
		//Enter "<some value>" in the textboxes to test with or without using the function.
    $message = htmlspecialchars("Thanks! info received...Name: ".$first . " " .$last . ", email: " .$email . ", gender: ". $gender. ", department: " .$department . ", status: ". $status. ", Agreed to terms: ". $agree);
		Header ("Location:Output.php?fn=".$message) ;			

		//$message = "Values are: ".$last . ", " .$first . ", ". $note;

	}

}
?>
