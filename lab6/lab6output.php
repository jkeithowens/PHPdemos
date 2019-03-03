<?php session_start(); //this must be the very first line on the php page, to register this page to use session variables

require_once "KeithDbConnect.php";

?>


<!doctype html>
<html lang="en">

<!-- Author: J. Keith Owens
File Name: lab6output.php
Created Date: 11/6/2018
Purpose: Utilizes jQuery datatable to display a list of results
Revision History:
JKO 11/6/2018 Original Build
-->
<head>
<meta charset="UTF-8">

<title></title>

<!-- needed for JS to run, put before JS script -->
<link rel="stylesheet" href='https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css'/>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() { $('#example').DataTable(); } );
</script>
</head>

<body>


	<header style="text-align: center">
		<h1>Search Results</h1>
  </header>


	<div style="width:70%; margin:auto">
    <?php

			$sql = "select * from UserRegistration where LastName = ".'"'.$_SESSION['last'].'"';
			$result = $DB->GetAll($sql);

//this should never return null since it is checked on the input page;
//if you remove line 81-87 and just include 'Header("location:lab6output.php");'
//then the result table would show with a message stating no values found
			if ($result == null) {
				echo "<h3 style='color:red'>Sorry no names were found that match that last name </h3>";
			} else {
				print '<br /><br /><span style="color:red">Data retrieved from database:</span><br/ >';
			}
                     //display the result in a table

			print '<table  id="example" class="display" cellspacing="0" width="100%">';
			print '<thead><tr><th>email</th><th>First Name</th><th>Last Name</th><th>Gender</th></tr></thead>';
			print '<tbody>';

			  foreach ($result as $row) {
    				//you can use function count($row) to get the total number of rows
				print '<tr>';
				print '<td>'.$row["UserName"]."</td><td>".$row["FirstName"]."</td><td>".$row["LastName"]."</td><td>".$row["UserGender"]."</td>";
				//now get the pictures related to this post
				print "</tr>";
			}

			print '</tbody>';
			print '</table>';

		?>
<br />
<br />

<button><a style='text-decoration: none' href = 'lab6.php'>New Search</a></button>


	</div>


</body>
</html>
