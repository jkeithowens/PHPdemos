<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>Process Query Strings</title>
	<style type = "text/css">
  		h1, h2 {
    		text-align: center;
  		}
	</style>

	</head>

	<body>

		<?php
			$fn = "";
			$ln = "";
			$gender = "";
			$state = "";
			$em = "";
			$fn = $_GET['fn'];
			$ln = $_GET['ln'];
			$em = $_GET['em'];			
			$gender = $_GET['g'];
			$state = $_GET['s'];

		?>
		<h1>User Registration Confirmation</h1>

			First Name: <?php print $fn; ?> <br />	
			Last Name: <?php print $ln; ?> <br />
			Email:	<?php print $em; ?> <br />
			Gender: <?php print $gender; ?> <br />
			State of Residence:<?php print $state; ?> <br />
			
					</form>



	</body>
</html>


