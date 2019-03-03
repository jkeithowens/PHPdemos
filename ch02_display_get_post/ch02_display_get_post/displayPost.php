<?php
	$message = '';

	$first = "";
	$last = "";
	$note = "";

	$fok = FALSE;
	$lok = FALSE;
	$flabel="First Name";
	$llabel="Last Name";

	//$_POST is a system array that stores values retrieved through a POST request
	//Notice that values are not sent as query strings
	//Other predefined variables - http://php.net/manual/en/reserved.variables.php
 
	if(isset($_POST['first_name']))
	{	$first = $_POST['first_name'];
		if ($first=="")
		{
			$flabel = '<font color="red">First Name</font>';
		
		}
		else $fok = TRUE;
	
	}
	if(isset($_POST['last_name']))
	{	$last = $_POST['last_name'];
		if ($last=="")
		{
			$llabel = '<font color="red">Last Name</font>';
		}
		else $lok = TRUE;

	}

	if(isset($_POST['note']))
		$note = $_POST['note'];

	if($fok==FALSE or $lok==FALSE)
		$message = "Please enter required field. ";
	else
	{
		//htmlspecialchars($string) converts certain HTML special characters(&, ', ", <, and >) to their corresponding HTML entities and returns the resulting string. 
		//Enter "<some value>" in the textboxes to test with or without using the function. 
		$message = htmlspecialchars("Values are: ".$last . ", " .$first . ", ". $note);
		//$message = "Values are: ".$last . ", " .$first . ", ". $note;

	}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Demonstrate POST</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<form action = "displayPost.php" method="post">
    <main>
      <h1>Demonstrate POST Method</h1>
	
	<?php print "<h2>".$message."</h2>"; ?>
      <label>*<?php print $flabel;?></label>
	 <input type="text" name="first_name" value="<?php print $first;?>"/><br>
	
	<label>*<?php print $llabel;?></label>
	 <input type="text" name="last_name" value="<?php print $last;?>"/><br>

	<label>Notes</label>
	<input type="text" name="note" value="<?php print $note;?>"/><br>


	<label>&nbsp;</label>
	 <input type="submit" value = "Submit"/><br>


      
    </main>
</form>
</body>
</html>
