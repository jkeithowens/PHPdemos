<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Basic multi-dimensional array</title>
</head>
<body>
<h1>Example 2</h1>

<form action = "multiArrayGenericProcess.php"
      method = "post">
<table>
<tr>
  <th>First city</th>
  <th>Second city</th>
</tr>

<!-- note each option value is numeric -->

<tr>
  <td>
    <select name = "cityA">
      <option value = "0">Indianapolis</option>
      <option value = "1">New York</option>
      <option value = "2">Tokyo</option>
      <option value = "3">London</option>
	   <option value = "4">Paris</option>
      <option value = "5">Frankfurt</option>
     </select>
   </td>

  <td>
    <select name = "cityB">
      <option value = "0">Indianapolis</option>
      <option value = "1">New York</option>
      <option value = "2">Tokyo</option>
      <option value = "3">London</option>
	 <option value = "4">Paris</option>
      <option value = "5">Frankfurt</option>
     </select>
  </td>
</tr>

<tr>
  <td colspan = "2">
    <input type = "submit" name="enter" value = "calculate distance" />
  </td>
</tr>
</table>
</form>
<?php 
$cityName = array("Indianapolis", "New York", "Tokyo", "London", "Paris","Frankfurt");

$distance = array(
  array(0, 648, 6476, 4000, 4166,4371),
  array(648, 0, 6760, 3470,3625,3852),
  array(6476, 6760, 0, 5956,6066,5798),
  array(4000, 3470, 5956, 0,292,484),
    array(4166,3625,6066,292,0,357),
  array(4371,3852,5798,484,357,0)
  
);
?>
</body>
</html>
