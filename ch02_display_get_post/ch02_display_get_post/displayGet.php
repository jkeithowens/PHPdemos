<?php
	$message = '';

	$first = "";
	$last = "";
	$note = "";

	$fok = FALSE;
	$lok = FALSE;
	$flabel="First Name";
	$llabel="Last Name";

	//$_GET is a system array that stores values retrieved through a GET request
	//Note the query string in the URL after submission
	//Other predefined variables - http://php.net/manual/en/reserved.variables.php
 
	if(isset($_GET['first_name']))
	{	$first = $_GET['first_name'];
		if ($first=="")
		{
			$flabel = '<font color="red">First Name</font>';
		
		}
		else $fok = TRUE;
	
	}
	if(isset($_GET['last_name']))
	{	$last = $_GET['last_name'];
		if ($last=="")
		{
			$llabel = '<font color="red">Last Name</font>';
		}
		else $lok = TRUE;

	}

	if(isset($_GET['note']))
		$note = $_GET['note'];

	if($fok==FALSE or $lok==FALSE)
		$message = "Please enter required field. ";
	else
	{
		//htmlspecialchars($string) converts certain HTML special characters(&, ', ", <, and >) to their corresponding HTML entities and returns the resulting string. 
		//Enter "<some value>" in the textboxes to test with or without using the function. 
		//$message = htmlspecialchars("Values are: ".$last . ", " .$first . ", ". $note);
		$message = "Values are: ".$last . ", " .$first . ", ". $note;

	}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Demonstrate GET</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<form action = "displayGet.php" method="get">
    <main>
      <h1>Demonstrate Get Method</h1>
	
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
