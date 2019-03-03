<?php
	session_start(); //this must be the very first line on the php page, to register this page to use session variables
      
	
	//if this is a page that requires login always perform this session verification
	require_once "inc/sessionVerify.php";



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>Process Query Strings</title>
	<style type = "text/css">
  		h1, h2 {
    		text-align: center;
  		}

		table {
    		border-top: double;
    		border-bottom: double;
    		border-right: blank
		}

		td, th { border: 1px solid }
	</style>

	</head>

	<body>
		Session Demo

		<br/><br/>

		<?php
			
			//retrieving session values
			print "<br/>session id is: ".session_id();
			print "<br/>session name is: ".session_name();
			print "<br/>email is: ".$_SESSION['email'];

			//other useful global variables
			print  "<br/><br/>document root is: ".$_SERVER['DOCUMENT_ROOT'];
			print  "<br/>server name is: ".$_SERVER['SERVER_NAME'];
			print  "<br/>server port is: ".$_SERVER['SERVER_PORT'];			
			print "<br/>current file is: ".$_SERVER['REQUEST_URI'];			
			//more at http://php.net/manual/en/reserved.variables.server.php


			//retrieving cookie value based on the id, if cookie is not expired 
			//if valid, will return the value, otherwise, return null
			//If activate line 67 in sessionDemo.php, cookie value cannot be retrived
			print "<br/><br/>cookie name is: ".filter_input(INPUT_COOKIE, 'userid', FILTER_VALIDATE_INT);

			
			
		?>
	
		</form>
		<br/><br/>
		<a href="logout.php">Logout</a>

	</body>
</html>


