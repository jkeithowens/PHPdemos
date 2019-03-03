<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>Process Query Strings</title>
	<style type = "text/css">
  		h1, h2 {
    		text-align: center;
  		}
	</style>

	</head>

	<body>
		Loop and Array Demo

		<br/><br/>

		<?php

			//For and While Loops
			echo "Simple For Loop:<br>";
			for ($count = 1; $count <= 10; $count++){
				echo  $count . ',';
			}

			// a for loop that displays a drop-down list
			print '<br><br><label>Interest Rate: </label>
				<select name = "rate">
				';
			for ($v = 5; $v <= 12; $v++){
				print '<option value = "'.$v.'">'.$v.'</option>';
			}
			
			print "</select><br>";


			//break out of a loop
			echo "<br><br>Break out of a For Loop:<br>";
			for ($count = 1; $count <= 10; $count++){
				echo  $count . ',';
				if ($count == 5) break;
			}

			
			//skip an interation in a loop
			echo "<br><br>skip an interation in a For Loop:<br>";
			for ($count = 1; $count <= 10; $count++){
				if ($count == 5) continue;
				echo  $count . ',';
				
			}
			

			echo "<br><br>Simple While Loop:<br>";
			$count = 1;
			while ($count <=10) {
				echo $count . ',';
				$count++;
			}
			

			//A do-while loop that counts dice rolls until a six is rolled
			echo "<br><br>Do While Loop:<br>";
			$rolls = 0;
			do {
				$rolls++;
				echo $rolls .",";
			}while (mt_rand(1,6) != 6);
			echo '<br>Number of times to roll a six '. $rolls;
						
			/*********************************************************************************
			* This section demonstrates the use of arrays
			* Notice the different ways of creating and using arrays
			*********************************************************************************/

			/********* Normal arrays using array index to access a value **********/
			//method 1, assign values directly
			$arrayA[0] = "Aa";
			$arrayA[1] = "Ab";
			$arrayA[2] = "";
			$arrayA[3] = "Ad";		


			//method 2, create the array object and assign values
			$arrayB = array();
			$arrayB[0] = "Ba";
			$arrayB[1] = "Bb";
			$arrayB[2] = "Bc";

			//method 3, initialize values when creating the array
			$arrayC = array("Ca", "Cb", "Cc");


			//loop through the arrays
			print "<br /><br /> Array A values: ";
			for ($i = 0; $i < count($arrayA); $i++)
				print $arrayA[$i].", ";

			print "<br /> Using foreach: ";
			foreach ($arrayA as $value)
				print $value.", ";

			print "<br /><br/ > Array B values: ";
			for ($i = 0; $i < count($arrayB); $i++)
				print $arrayB[$i].", ";

			print "<br /> Using foreach: ";
			foreach ($arrayB as $value)
				print $value.", ";


		
			print "<br /><br /> Array C values: ";
			for ($i = 0; $i < count($arrayC); $i++)
				print $arrayC[$i].", ";

			print "<br /> Using foreach to iterate through an array: ";
			foreach ($arrayC as $value)
				print $value.", ";	
			
			/*******Associative Arrays use a name/value pair to access a value **********/

			//method 1, assign values directly
			$arrayD["first"] = "Da";
			$arrayD["third"] = "Dc";			
			$arrayD["second"] = "Db";
			

			//cannot use index to access the values
			//print "<br /><br/ > using index Array D values: ";
			//for ($i = 0; $i < count($arrayD); $i++)
				//print $arrayD[$i].", ";

			//can use for each to access the values
			print "<br /><br /> Using foreach in arrayD: ";
			foreach ($arrayD as $value)
				print $value.", ";	

			//using foreach to assign the label to a variable and the value to a variable
			print "<br /><br /> Using foreach in arrayD specifying the label and value: ";
			foreach ($arrayD as $pos => $value)
				print $pos . "-" . $value . ", ";

			//use name/value pair to access a particular value
			print "<br /><br />Second element in arrayD: ".$arrayD["second"];

			//method 2, create an array object then array values
			$arrayE = array();
			$arrayE["first"] = "Ea";
			$arrayE["second"] = "Eb";
			$arrayE["third"] = "Ec";
			print "<br /><br />Third element in arrayE: ".$arrayE["third"];

			//method 3, create an array and initialize values
			$arrayF = array("first" =>"Fa", "second" =>"Fb", "third" =>"Fc");
			print "<br /><br />First element in arrayF: ".$arrayF["first"];
	

			//array for in class lab
			$arrayLab = array();
			$arrayLab["1"] = "Apple";
			$arrayLab["2"] = "Carrot";
			$arrayLab["3"] = "Pizza";
			$arrayLab["4"] = "Ice Cream";
			$arrayLab["5"] = "Coffee";

	print "<br />";
	print '<select>';
			foreach ($arrayLab as $pos => $value) 
	         		 print '<option value = "' .$pos .'">' .$value. '</option>';

	print '</select>';


			
				
			
		?>
	
		</form>
		<br/><br/>
		

	</body>
</html>


