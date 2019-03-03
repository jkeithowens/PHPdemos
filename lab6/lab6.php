
<!-- Author: J. Keith Owens
File Name: lab6.php
Created Date: 11/6/2018
Purpose: To demonstrate an AJAX request that will generate a possible list of names based on
  what the user begins to type.  Then a SQL query is ran and a jQuery data table is used to
  display user data for users with that last name
Revision History:
JKO 11/6/2018 Original Build
-->


<?php session_start();
require_once "pdoDbCon.php";
?>

<!DOCTYPE html>
<html>
<head>
<script>

//Ajax request that uses GET request to look up last names based on first input value(s)
//then returns a list without having to reload the page
function showNameHint(str)
{
var xmlhttp;
if (str.length==0)
  {
  document.getElementById("browsers").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      //upon sucessful Ajax request, the list of possible last names is sent to the "browsers" element
    document.getElementById("browsers").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","lab6Process.php?startOfName="+str,true);
xmlhttp.send();
}
</script>
</head>
<body>
  <h3>Search user registration by last name:</h3>
  <form action="lab6.php">
  Start typing last name:

  <!-- After a letter is typed, the showNameHint Function is called in the Ajax request -->
  <input autocomplete="off" type="text" list="browsers" name="vName" value="" onkeyup="showNameHint(this.value)" />
  <datalist id="browsers" >
  </datalist>
  <input name="enter" class="btn" type="submit" value="Submit" />
  <br/><br/>
  Click submit to see user data
  </form>

</body>
</html>

<!-- Once the submit button is clicked, a session variable "last" is assigned to the value of the input field, lookup count makes sure there is at least one name that matches -->
<!-- this value is sent to lab6output.php where it is used to do a lookup of all users with the last name "last" -->
<?php if(isset($_GET['enter']))	{
  $_SESSION['last'] = $_GET['vName'];

  $sql = "select count(*) as c from UserRegistration where LastName ='".$_SESSION['last']."';";
  $stmt = $con->query($sql);
  if (!$stmt) {
    $msg = "error";
  }
  else {
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $row->c;
    if ($count > 0) {
      Header("location:lab6output.php");
    } else {
      print "<h3 style='color:red'>sorry no such name found</h3>";
    }
  }


} ?>
