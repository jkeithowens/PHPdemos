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




//create the csv file if it doesn't exist
$fp = fopen("csv/distanceChart.csv", "w");  

//write the file header
fputcsv($fp, $cityName);

//write the distance array into the csv file
foreach($distance as $fields)
{
	fputcsv($fp, $fields);
}

//close the file handler
fclose($fp);


print 'Click <a href="http://corsair.cs.iupui.edu:18081/murach/ch23_file_process/csv/distanceChart.csv">here</a> to download the csv file';


//read the csv file and write to the web page

print '<br /><br /><span style="color:red">The following data is read from the csv file</span><br />';
$row = 1;
if (($fp = fopen("csv/distanceChart.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) { //read max 1000 characters. Omitting this will make the reading a bit slower
        $num = count($data);
        print "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
		if ($c == $num - 1) print $data[$c];
		else 
            		print $data[$c] . ", ";
        }
   	print "<br />";
    }
    fclose($fp);
}
else die();





?>

</body>
</html>