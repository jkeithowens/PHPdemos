<?php session_start(); //this must be the very first line on the php page, to register this page to use session variables
      	$_SESSION['timeout'] = time();

	//if this is a page that requires login always perform this session verification
	require_once "inc/sessionVerify.php";
	require_once "KeithTestDbConnect.php";
  include "header.php";
?>
 
<!DOCTYPE html PUBLIC>
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>Process Query Strings</title>
  <!-- Bootstrap & Jquery scripts-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <!-- Stylesheet link -->
  <link href="style.css" rel="stylesheet">

	</head>

	<body>


		<br/><br/>

		<?php
			$fn = "";
			$ln = "";
			$gender = "";
			$state = "";


			//retrieve First and Last Name from Database
			$stmt = $con->prepare("select * from UserRegistration where UserName = ?");
			$stmt->execute(array($_SESSION['email']));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			print "<h1>Welcome ".$row["FirstName"]. " " . $row["LastName"]. "</h1> ";

			$stmt->closeCursor();


		?>

		</form>
		<br/><br/>
    <a href="ChangePassword.php"><button>Change Password</button></a>
		<a href="Lab5LogOut.php"><button>Log Out</button></a>

	</body>
</html>
