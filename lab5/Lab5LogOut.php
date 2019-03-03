<!-- Author: J. Keith Owens
File Name: Lab5LogOut.php
Created Date: 10/15/2018
Purpose: Serves as a page to logout for the registration page labs
JKO 10/15/2018 Original Build
-->

<?php  session_start(); //this must be the very first line on the php page, to register this page to use session variables
	session_destroy(); //destroys the session variables once the page loads
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>Logout</title>
	<!-- Bootstrap & Jquery scripts-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

	<!-- Stylesheet link -->
	<link href="style.css" rel="stylesheet">

	</head>
  <?php include "header.php"; ?>
	<body>
			<br />
			<br />
			<h1>Logout</h1>
			<h6>Thank you for visiting our web site!</h6>
	</body>
</html>
