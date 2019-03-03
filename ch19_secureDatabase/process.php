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
		Session and Array Demo

		<br/><br/>

		<?php
			$fn = "";
			$ln = "";
			$gender = "";
			$state = "";


			//retrieve all the information from the user from the database
			//retrieve all the information from the user from the database
			
			print "session email is ". $_SESSION['email'];

			$stmt = $con->prepare("select * from REGISTRATION where username = ?");
			$stmt->execute(array($_SESSION['email']));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			print " user name is ".$row["UserName"]. " and gender is ". $row["Gender"]. "<br />";

			/*************Retrieve data from database*****************************************************
			/* run linglu_dbExport02_11_2013.sql file to create the tables and views used in this example 
			/**********************************************************************************************/


            		//display the result in a table
			//more examples on page 621, 623, or slides Chapter 19, slide #11-#17
			print '<br /><br /><span style="color:red">Data retrieved from database:</span><br/ >';
			print '<table>';
			print '<tr><td>Category</td><td>Title</td><td>Description</td><td>PostDate</td><td>Pictures</td></tr>';


			$stmt = $con->prepare("select * from VW_ALL_POSTS where UserName = ?");
			$stmt->execute(array($_SESSION['email']));

			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    				//you can use function count($row) to get the total number of rows
				print '<tr>';
				print '<td>'.$row["Category"]."</td><td>".$row["Title"]."</td><td>".$row["Description"]."</td><td>".$row["PostDate"]."</td>";
				//now get the pictures related to this post
				//$sql = "select PicLink from POST_PIC where PostID = " . $row['PostId'];

				$st = $con->prepare("select PicLink from POST_PIC where PostID = ? ");
				$st->execute(array($row['PostId']));
				print "<td>";
				while($pics  = $st->fetch(PDO::FETCH_ASSOC)) {

					print '<img src="images/'.$pics["PicLink"].'" width="100" height="100" /> ';

				}				
				$st->closeCursor(); //close the cursor to free the connection to the server
				print "</td>";
				print "</tr>";

			}
			$stmt->closeCursor();
			
			print '</table>';

			
			
		?>
	
		</form>
		<br/><br/>
		<a href="logout.php">Log Out</a>

	</body>
</html>


