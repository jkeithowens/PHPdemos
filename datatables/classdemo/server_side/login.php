<?php  session_start(); //this must be the very first line on the php page, to register this page to use session variables
	$_SESSION['timeout'] = time(); //record the time at the user login 

	require_once "inc/util.php";
	require_once "dbconnect.php";
	//always initialized variables to be used
	$msg = "";	
	$uname = "";
	$pwd = "";
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>Login</title>
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
				
				
				//take the information submitted and verify inputs
				$uname =  trim($_POST['userName']); //no need to escape string if using prepared statements and parameterized arguments
				$pwd = trim($_POST['pwd']);	

								
				//hash the current passwored entered by the user. It should match with the hashed one in database
				//Security measure 2, always protect password
				//$pwd = sha1($pwd);

				//now veriy the username and password
				if (spamcheck($uname)) //if the email is not a valid format, don't need to continue at all
				{     
					
					$stmt = $con->prepare("select count(*) as c from REGISTRATION where username = ? and password = ?");
					$stmt->execute(array($uname, $pwd));
					$row = $stmt->fetch(PDO::FETCH_OBJ);
					
					$count = $row->c;
					print "count is ".$count;
					//security measure 4: always use the actual value, don't do $count>0
					if ($count == 1)
					{

					
						$stmt = $con->prepare("Select id  from REGISTRATION where username = ? and password = ?");
						$stmt->execute(array($uname, $pwd));
						$row = $stmt->fetch(PDO::FETCH_OBJ);
					
						$uid = $row->id;
						

						/************************************************************************************************
						*Session variables are variables that belong to the session scope. 
						*They exit when a new session starts, and they are destroyed either when a session is killed or expired.
						*Instructions and concerns on using sessions can be found at http://www.php.net/manual/en/book.session.php.
						*User defined session variables can be used to pass data from one page to another. 
						*/
						$_SESSION['uid'] = $uid;
						$_SESSION['email'] = $uname;
						Header ("Location:process.php");

					}
					else $msg = "The information entered does not match with the records in our database.";


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

		<form action="login.php" method="post">
			<h1>Login</h1>
			<?php 
				print $msg;
				$msg = "";
			?>
			<br />
			Username (email): <input type="text" maxlength = "50" value="lancylu@hotmail.com" name="userName" id="userName"   /> <br />
			Password: <input type="text" maxlength = "50" value="222" name="pwd" id="pwd"   /> <br />

			
			<br />
			<br />


			<input name="enter" class="btn" type="submit" value="Submit" />

			<br /><br />
			<a href = "forget.php">Forget Password?</a>
		</form>



	</body>
</html>
