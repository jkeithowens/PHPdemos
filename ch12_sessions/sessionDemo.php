<?php  session_start(); //this must be the very first line on the php page, to register this page to use session variables
	$_SESSION['timeout'] = time(); //record the time at the user login 

	require_once "inc/util.php";
	
	//always initialized variables to be used
	$msg = "";	
	$uname = "linglu3@iupui.edu";
	$pwd = "222222aaaaaa";

	
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
				$uname =  trim($_POST['userName']);
				$pwd = trim($_POST['pwd']);		

				//now veriy the username and password
				if (spamcheck($uname)) //if the email is not a valid format, don't need to continue at all
				{     
					/************************************************
					/*setting session variables
					/***********************************************/
					$_SESSION['email'] = $uname;
				       

					
					/******************************************************************************
					/*A cookie is stored in the browser to store insensitive information such as name of the user. 
					/*The information can be retrieved in later visits. Browser must enable cookies.
					/*To set a cookie, use the function:
					/*setcookie($name, $value, $expire, $path, $domain, $secure, $httponly)
					/*The only required parameter is $name. 
					/*Default values for other parameters:
					/*$value: Empty string
					/*$expire: 0, the cookie expires when the user closes the browser.
					/*$path: the directory of the PHP file that is setting the cookie. Should be set to the root of your website. 
					/*$domain: name of the server that is setting the cookie. 
					/*$secure: FALSE
					/*httponly: FALSE
					/******************************************************************************/ 
					$name = 'userid';
					$value = '87';
					$expire = strtotime('+1 year'); //expire one year later
					$path = 'corsair.cs.iupui.edu:18081/murach/ch12_sessions/'; //if set to '/', the cookie is available to all directories on the current server
					setcookie($name, $value, $expire, $path);
					//setcookie($name, $value,0, $path); //$expire is 0, will expire when browser is closed
					Header ("Location:sessionProcess.php") ;
					

				}
				else $msg = "The information entered is incorrect.";
						
			}
				
		?>

		<form action="sessionDemo.php" method="post">
			<h1>Login</h1>
			<?php 
				print $msg;
				$msg = "";
			?>
			<br />
			Username (email): <input type="text" maxlength = "50" value="linglu3@iupui.edu" name="userName" id="userName"   /> <br />
			Password: <input type="text" maxlength = "50" value="222222aaaaaa" name="pwd" id="pwd"   /> <br />

			
			<br />
			<br />


			<input name="enter" class="btn" type="submit" value="Submit" />

			<br /><br />
			<a href = "forget.php">Forget Password?</a>
		</form>



	</body>
</html>
