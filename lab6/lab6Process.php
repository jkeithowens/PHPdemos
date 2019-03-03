<!-- Author: J. Keith Owens
File Name: lab6Process.php
Created Date: 11/6/2018
Purpose: Performs a SQL table lookup and returns the results to the AJAX GET request in lab6.php
Revision History:
JKO 11/6/2018 Original Build
-->

<?php session_start(); 

//connects to the jkowens corsair Db
require_once "KeithDbConnect.php";

// Fill up array with names, only displays each name once using "distinct"
$sql = "select distinct LastName from UserRegistration";
$result =$DB->Execute($sql);

// get the startOfName parameter from URL
$startOfName=$_REQUEST["startOfName"];

$hint="";

// lookup all hints from array if $startOfName is different from ""
if ($startOfName !== "")
{
	//converts all inputs to lowercase
	$startOfName=strtolower($startOfName);
	//creates variable that stores length of input string
	$len=strlen($startOfName);


    	foreach($result as $name)
    	{
//test if $startOfName matches with the first few characters of the same length in the lastname
//loop through each row to catch all cases that match
		if (stristr($startOfName, substr($name['LastName'],0,$len))) //checks value for as many letters in input string
      		{
			if ($hint==="")
       		{
				$hint = "<option>". $name['LastName']."</option>";
 			}
        		else
        		{
			$hint .= "<option>". $name['LastName']."</option>";
			}
      		}
    	}
}

print $hint;

?>
