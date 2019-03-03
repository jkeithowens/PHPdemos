<?php session_start(); //this must be the very first line on the php page, to register this page to use session variables
      	$_SESSION['timeout'] = time();
	
	//if this is a page that requires login always perform this session verification
	require_once "inc/sessionVerify.php";

	require_once "dbconnect.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>Datatables</title>
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


	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/favicon.ico">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">

	<title>DataTables example - Zero configuration</title>
	<link rel="stylesheet" type="text/css" href="../../media/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="../resources/syntax/shCore.css">
	<link rel="stylesheet" type="text/css" href="../resources/demo.css">
	<style type="text/css" class="init">

	</style>
	<script type="text/javascript" language="javascript" src="../../media/js/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="../../media/js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="../resources/syntax/shCore.js"></script>
	<script type="text/javascript" language="javascript" src="../resources/demo.js"></script>
	<script type="text/javascript" language="javascript" class="init">


$(document).ready(function() {
	$('#example').DataTable();
} );


	</script>




	</head>

	<body>
		Session and Array Demo

		<br/><br/>

		<?php
			$fn = "";
			$ln = "";
			$gender = "";
			$state = "";


			//retrieve all the information from the user from the database
			//always check if the session variable exists before using it for the first time on this page. 
			if (isset($_SESSION['email']))
				$sql = "select * from REGISTRATION where username = '".$_SESSION['email']."'";
			//else Header ("Location:logout.php") ;

			print "session email is ". $_SESSION['email'];

			$stmt = $con->prepare("select * from REGISTRATION where username = ?");
			$stmt->execute(array($_SESSION['email']));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			print " user name is ".$row["UserName"]. " and gender is ". $row["Gender"]. "<br />";

			/*************Retrieve data from database*****************************************************
			/* run linglu_dbExport02_11_2013.sql file to create the tables and views used in this example 
			/**********************************************************************************************/


                     //display the result in a table
			print '<br /><br /><span style="color:red">Data retrieved from database:</span><br/ >';
			print '<table  id="example" class="display" cellspacing="0" width="100%">';
			print '<thead>
<tr><th>Category</th><th>Title</th><th>Description</th><th>PostDate</th><th>Pictures</th></tr></thead><tfoot>
<tr><th>Category</th><th>Title</th><th>Description</th><th>PostDate</th><th>Pictures</th></tr></tfoot>';


			$stmt = $con->prepare("select * from VW_ALL_POSTS where UserName = ?");
			$stmt->execute(array($_SESSION['email']));

			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    				//you can use function count($row) to get the total number of rows
				print '<tr>';
				print '<td>'.$row["Category"]."</td><td>".$row["Title"]."</td><td>".$row["Description"]."</td><td>".$row["PostDate"]."</td>";
				//now get the pictures related to this post
				
				$st = $con->prepare("select PicLink from POST_PIC where PostID = ? ");
				$st->execute(array($row['PostId']));
				print "<td>";
				while($pics  = $st->fetch(PDO::FETCH_ASSOC)) {

					print '<img src="images/'.$pics["PicLink"].'" width="100" height="100" /> ';

				}				

				print "</td>";
				print "</tr>";

			}

			
			print '</table>';

			
			
		?>
	
		</form>
		<br/><br/>
		<a href="logout.php">Log Out</a>

	</body>
</html>


