<?php session_start(); //this must be the very first line on the php page, to register this page to use session variables

 

 

require_once "dbconnect.php";

 

 

$q = $_GET['q']; //get the values passed from this query string

 

 

$sql = "select LastName from REGISTRATION";

 

 

$result = $DB->GetAll($sql);

// get the q parameter from URL

$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from

if ($q !== "") {

$q = strtolower($q);

$len=strlen($q);

foreach($result as $name) {

	if (stristr($q, substr($name['LastName'], 0, $len))) {

		if ($hint === "") {

			$hint = $name['LastName'];

		} else {

				$hint .= ",". $name['LastName'];

		}

	}

}

}

// Output "no suggestion" if no hint was found or output correct values

echo $hint === "" ? "no suggestion" : $hint;

 

?>