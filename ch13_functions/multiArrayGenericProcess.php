<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Distance Calculator</title>
</head>
<body>
<h1>Distance Calculator</h1>
<?php
//include "multiArrayGenericStart1.php";
include "multiArrayGenericStart2.php";


if (isset($_POST['enter'])) {


$cityA = filter_input(INPUT_POST, "cityA");
$cityB = filter_input(INPUT_POST, "cityB");

$fromCity = "";
$toCity = "";

//$result = getDistance($cityName, $distance, $fromCity, $toCity, $cityA, $cityB);
$result = getDistanceGlobal($fromCity, $toCity, $cityA, $cityB); //use global variables to avoid passing references


print "<h2>The distance between $fromCity and $toCity is $result miles.</h2> \n";
}

/*****************************************************************************************
/*By default, all function arguments are passed by value. 
/*Placing an "&" in front of a parameter results in the argument passed by reference. 
/*Passing by reference is used 1)to avoid passing a copy of a large object into a function 
/*2) to pass multiple values out of the function
/******************************************************************************************/
function getDistance(&$nameList, &$chart, &$from, &$to, $index1, $index2){
	echo "Inside function";
	$from = $nameList[$index1];
	$to = $nameList[$index2];

	$d = $chart[$index1][$index2];
	
	return $d;
}

/*************************************
/*Demonstrate using global variables
/************************************/
function getDistanceGlobal(&$from, &$to, $index1, $index2){
	echo "Inside Global";
	
	global $cityName, $distance; //must call out global variables (variables declared outside of the function)
	
	$from = $cityName[$index1];
	$to = $cityName[$index2];

	$d = $distance[$index1][$index2];
	
	return $d;
}

?>

</body>
</html>