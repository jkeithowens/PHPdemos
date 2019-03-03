<?php session_start(); //this must be the very first line on the php page, to register this page to use session variables
      
	
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
		table
		{
		border-collapse:collapse;
		}
		table,th, td
		{
		border: 1px solid black;
		}
		td
		{
		padding:15px;
		}
	</style>

	</head>

	<body>
	<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">		
		Checkout

		<br/><br/>

		<?php
			//Determine what checkboxes are selected and find out the pictures ordered
			//get the hidden value from the previous page
			$count = 0;
			if (isset($_POST["boxCount"]))
			{  $count = $_POST["boxCount"];
			   $picList = "";
			   for ($i=1; $i <= $count; $i++)
				{     // print " test pic selected: " .$_POST["chpic".$i];
					if(isset($_POST["chpic".$i]))
					{
						$picList = $picList.$i.",";

						//print " pic selected: " .$i;
					}
				}
			    //when the for loop ends, the array will only contain the IDs that are selected
			

			//get rid the last comma in the picList
			$picList = substr($picList, 0,strlen($picList)-1 );
			//Now use these IDs to query the database to get all other information to record that are ordered and from who
			$sql = "select UserID, PicID from VW_ALL_POSTS_WITH_PIC where picID in (".$picList.")";
			
			$result = $DB->GetAll($sql);

			$tranxID = date("YmdHis").$_SESSION["uid"].'-'.$count;
			$total = 0;
			$price = 1.00;
			foreach ($result as $row)
			{
				$DB->Execute("insert into ORDER values(null,".$row["PicID"].", ".$row["UserID"].", ".$_SESSION["uid"].", 1.00, '".date("Y-m-d")."', '".$tranxID."')");
				$total = $total + $price;
			}

			$DB->Execute("insert into TRANSACTION values(null,".$_SESSION["uid"].", '".$tranxID."', '".$total."', null, 'No')");

			}			


		?>

		<!-- now prepare the values to submit to paypal -->
		<input type="hidden" name="cmd" value="_xclick">
		<!-- You can create a secured button in the business paypal account if price is fixed, thus a lot of information such as business email can be hidden.
			<input type="hidden" name="hosted_button_id" value="9098757">
		-->
		<input type="hidden" name="business" value="n431bn@gmail.com"> 
		<input type="hidden" name="amount" value="<?php print $total; ?>">
		<input type="hidden" name="option_name1" value="TranxID">
              <input type="hidden" name ="option_selection1" value="<?php print $tranxID; ?>">
             
		Your order summary: <br />
		Total: $<?php print $total; ?> <br />
		Transaction ID: <?php print $tranxID; ?> <br />

		Note: login to paypal sandbox to pay, with email "n431sb_1301944784_per@gmail.com" and password: "n431sb_1301944784"
		<br />
		<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">

	</form>
		<br/><br/>
		<a href="logout.php">Logout</a>

	</body>
</html>


