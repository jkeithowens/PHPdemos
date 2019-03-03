<?php session_start(); //this must be the very first line on the php page, to register this page to use session variables
      
	
	//if this is a page that requires login always perform this session verification
	require_once "inc/sessionVerify.php";



	require_once "dbconnect.php";


	if (!isset($_SESSION['email']))
		Header ("Location:logout.php") ;

	$q = $_GET['q']; //get the values passed from this query string

	

	$sql = "select * from VW_ALL_POSTS where Category = '".$q."'";
			
			
			$result = $DB->GetAll($sql);

						
                     //display the result in a table
			print '<br /><br /><span style="color:red">Data retrieved from database:</span><br/ >';
			print '<table style = "border:1px solid green;">';
			print '<tr><td>Category</td><td>Title</td><td>Description</td><td>PostDate</td><td>Pictures</td></tr>';

			//get the rows
			$i = 0; //This is used to remember how many checkboxed created in total
			foreach ($result as $row)
			{
				print "<tr>";
				print "<td>".$row["Category"]."</td><td>".$row["Title"]."</td><td>".$row["Description"]."</td><td>".$row["PostDate"]."</td>";
				//now get the pictures related to this post
				$sql = "select ID, PicLink from POST_PIC where PostID  = " . $row['PostId'];
				$picResult =$DB->GetAll($sql);

				$_SESSION["picResult"] = $picResult; //store the result in session variable to be used later

				print "<td>";
				
				//need to dynamically create checkboxes, thus need to give a unique id for each checkbox. This id is used to check if a checkbox is selected after submission
				foreach ($picResult as $pics)

				{	$i++;
					print '<img src="images/'.$pics["PicLink"].'" width="100" height="100" /><input type="checkbox" name="chpic'.$pics["ID"].'" value="1.0">$1.00 ';
					
				}				

				print "</td>";
				print "</tr>";

				//this hidden field is submitted for the next page to know how many checkboxes were created in this page so as to create a loop in the next page
				print '<input type="hidden" name ="boxCount" value="'.$i.'">';

			}


			print '</table>';

			
?>

