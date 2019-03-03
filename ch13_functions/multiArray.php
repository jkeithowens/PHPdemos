<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Distance Calculator</title>
</head>
<body>
<h1>Distance Calculator</h1>
<?php

$cityName = array("Indianapolis", "New York", "Tokyo", "London");

$distance = array(
  array(0, 648, 6476, 4000),
  array(648, 0, 6760, 3470),
  array(6476, 6760, 0, 5956),
  array(4000, 3470, 5956, 0)
);

$cityA = filter_input(INPUT_POST, "cityA");
$cityB = filter_input(INPUT_POST, "cityB");

$fromCity = $cityName[$cityA];
$toCity = $cityName[$cityB];

$result = $distance[$cityA][$cityB];

print "<h2>The distance between $fromCity and $toCity is $result miles.</h2> \n";

?>

</body>
</html>