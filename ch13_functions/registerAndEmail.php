<?php 
	require_once "inc/util.php";
	require_once "mail/mail.class.php";

	$msg = "";
	$term = "You must agree to the terms and conditions";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>Functions Demo</title>
	<style type = "text/css">
  		h1, h2 {
    		text-align: center;
  		}
	</style>

	</head>

	<body>

		<?php
			if (isset($_POST['enter']))
			{
				//always initialized variables to be used
				$uname = "";
				$pwd = "";
				$cpwd = "";
				$fn = "";
				$ln = "";
				$gender = "";
				$state = "";
				$birthYear = "";
				$agree = "";

				$unameok = false;
				$pwdok = false;
				$agreeok = false;
				
				//take the information submitted and verify inputs
				$uname =  trim($_POST['userName']);
				$pwd = trim($_POST['pwd']);		
				$cpwd  = trim($_POST['confirmPwd']);			
				$fn = trim($_POST['firstName']); //always trim the user input to get rid of the additiona white spaces on both ends of the user input
				$ln = trim($_POST['lastName']);
				$gender = trim($_POST['gender']);
				$state = $_POST['state'];
				$birthYear = $_POST['birthYear'];
				

				if (!spamcheck($uname))							
					$msg = $msg . '<br/><b>Email is not valid.</b>';
				else $unameok = true;

				if (!pwdValidate($pwd))
					$msg = $msg . '<br/><b>Password is not in the required format.</b>';
				else {
					if ($pwd != $cpwd)
						$msg = $msg . '<br/><b>Passwords are not the same.</b>';
					else $pwdok = true;
				}
				if (!isset($_POST['agree'])) {
					$msg = $msg .  "<br/><b> You must agree to the terms and conditions </b><br />";
					$term = '<span style="color:red">You must agree to the terms and conditions</span>';

				}
				else $agreeok = true;

				if ($unameok && $pwdok && $agreeok) {
					//you will enter data into the database here

					//now send the email to the username registered for activating the account
					$code = randomCodeGenerator(30);
					$subject = "Email Activation";
										
					$body = 'Please click on this url to activate your account. <br/>
						 http://corsair.cs.iupui.edu:18181/demo/chap1/activate.php?a='.$code;
					$mailer = new Mail();
					if (($mailer->sendMail($uname, $fn, $subject, $body))==true)
						$msg = "<b>Thank you for registering. A welcome message has been sent to the address you have just registered.</b>";
					else $msg = "Email not sent. " . $uname.' '. $fn.' '. $subject.' '. $body;
					
					//direct to the next page if necessary
					//Header ("Location:process.php?fn=".$fn."&ln=".$ln."&g=".$gender."&s=".$state."&b=".$birthYear) ;	
				}
						
			}
		?>

		<form action="registerAndEmail.php" method="post">
			<h1>User Registration</h1>
			<?php 
				print $msg;
				$msg = "";
			?>
			<br />
			Username (email): <input type="text" maxlength = "50" value="" name="userName" id="userName"   /> <br />
			Password: <input type="text" maxlength = "50" value="" name="pwd" id="pwd"   />(Must be longer than 12 characters and contains at least 1 digit) <br />

			Confirm Password: <input type="text" maxlength = "50" value="" name="confirmPwd" id="confirmPwd"   /> <br />

			First Name: <input type="text" maxlength = "50" value="" name="firstName" id="firstName"   /> <br />	
			Last Name: <input type="text" maxlength = "50" value="" name="lastName" id="lastName"   />  <br />	
			Gender: 
				<input type = "radio" name = "gender" value = "Male" checked = "checked" />Male
				<input type = "radio" name = "gender" value = "Female" />Female <br />
			State of Residence:
			<select  name = "state">
				<?php print stateOptionList(); ?>
			</select>

			<br />
			Year of Birth:
			<select  name = "birthYear">
				<?php 
					$yr = $today["year"];
					print birthOptionList($yr); 

				?>
			</select>

			<br />

			<input type="checkbox" name = "agree" value="y" /> 
			<?php print $term; ?>
			<br />


			<input name="enter" class="btn" type="submit" value="Submit" />
		</form>



	</body>
</html>


