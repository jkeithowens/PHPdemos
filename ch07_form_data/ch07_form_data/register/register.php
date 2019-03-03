<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>User Registration</title>
	<style type = "text/css">
  		h1, h2 {
    		text-align: center;
  		}
	</style>

	</head>

	<body>

		<?php
			//always initialize variables to be used
			$fn = "";
			$ln = "";
			$em = "";
			$gender = "";
			$state = "";
			$msg = "";
			$fnre="*";
			$lnre="*";
			$emre="*";
			$maleChecked = "";
			$femaleChecked = "";

			
			

			if (isset($_POST['enter'])) //check if this page is requested after Submit button is clicked
			{
				
				//take the information submitted and send to a process file
			
				$fn = trim($_POST['firstName']); //always trim the user input to get rid of the additiona white spaces on both ends of the user input
				
				
				
				$ln = trim($_POST['lastName']);

				//use filter_input function to validate email
				if (!filter_input(INPUT_POST, 'email',FILTER_VALIDATE_EMAIL)) 
					$emre = '<span style="color:red">*</span>';
				else $em = trim($_POST['email']);
				
				if (isset($_POST['gender']))
					$gender = trim($_POST['gender']);
		
				
				if ($gender=="Male") {
					$maleChecked="checked";
					$femaleChecked="";
				}
				else {
					$maleChecked="";
					$femaleChecked="checked";
				}
				$state = trim($_POST['state']);
				
				if ($fn== "")
					$fnre = "<span style=\"color:red\">*</span>";
				
				if ($ln== "")
					$lnre = '<span style="color:red">*</span>';
				

				if (($fnre!="*") || ($lnre != "*") || ($emre != "*"))				
				{	
					$msg = "<br /><span style=\"color:red\">Please enter valid data.</span><br />";
				}
				else {
										
					//direct to another file to process using query strings
					Header ("Location:process.php?fn=".$fn."&ln=".$ln."&em=".$em."&g=".$gender."&s=".$state) ;			
				}
			}
		?>

		<form action="register.php" method="post">
			<h1>User Registration</h1>
			
			<?php
				print $msg;
			?>
			
			First Name: <?php print $fnre; ?>
				 <input type="text" maxlength = "50" value="<?php print $fn; ?>" name="firstName" id="firstName"  placeholder="First Name" /> <br />	
			Last Name: <?php print $lnre; ?>
				<input type="text" maxlength = "50" value="<?php print $ln; ?>" name="lastName" id="lastName"  placeholder="Last Name" />  <br />
			Email: <?php print $emre; ?>
				<input type="text" maxlength = "50" value="<?php print $em; ?>" name="email" id="email"   />  <br />	
			Gender: 
				<input type = "radio" name = "gender" value = "Male" <?php print $maleChecked; ?> />Male
				<input type = "radio" name = "gender" value = "Female"  <?php print $femaleChecked; ?> />Female <br />
			State of Residence:
			<select  name = "state">
  				<option value = "IN">Indiana</option>
  				<option value = "NY" selected>New York</option>
  				<option value = "IL">Illinois</option>
  				<option value = "FL">Florida</option>
  				<option value = "CO">Colorado</option>
			</select>

			<input name="enter" class="btn" type="submit" value="Submit" />
		</form>



	</body>
</html>


