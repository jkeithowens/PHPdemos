
		
<?php 
include "UserConstructor.php";
session_start(); //this must be the very first line on the php page, to register this page to use session variables
//must include UserConstructor.php or object won't load

      	$_SESSION['timeout'] = time();

	//if this is a page that requires login always perform this session verification
	require_once "KeithTestDbConnect.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>Process Query Strings</title>

	</head>

	<body>
<?php
// $ID = 'ID';
// $DeptName = 'DeptName';
// $sql = mysql_query("SELECT * FROM Dept ORDER BY ID ASC");
// $rows = mysql_fetch_assoc($sql);

// $stmt = $con->prepare("select * from Dept where ID = ?");
// $stmt->execute(array('4'));
// $row = $stmt->fetch(PDO::FETCH_ASSOC);
// print $row;
// print " dept is ".$row["DeptName"]. "<br />";

// $stmt = $con->prepare("select * from Dept");
// $stmt->execute();
// $row = $stmt->fetch(PDO::FETCH_ASSOC);
// print $row;
// print " dept is ".$row["DeptName"]. "<br />";
$username = "joekeitho@yahoo.com";
$stmt = $con->prepare("select * from UserRegistration where UserName = ?");
$stmt->execute(array($username));
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      //you can use function count($row) to get the total number of rows
  print '<tr>';
print " dept is ".$row["UserName"]. "<br />";
print " dept is ".$row["UserGender"]. "<br />";
print " dept is ".$row["UserPassword"]. "<br />";
print " dept is ".$row["FirstName"]. "<br />";
  //now get the pictures related to this post
  //$sql = "select PicLink from POST_PIC where PostID = " . $row['PostId'];
  print "</td>";
  print "</tr>";

};

$test= $_SESSION['userInfo']->FirstName;
$object = $_SESSION['userInfo'];

    $stmt = $con->prepare("insert into UserRegistration values('','$object->email','$object->password','$object->FirstName','$object->LastName','$object->gender','$object->department','$object->status','$object->code','No')");
    $stmt->execute();
	
	

        print "<h4> Your Last Name: ".($_SESSION['userInfo']->LastName)."</h1>"; 
        print "<h4> Your User Name: ".($_SESSION['userInfo']->email)."</h1>"; 
         print "<h4> Your password: ".($_SESSION['userInfo']->password)."</h1>"; 
        print "<h4> Your gender: ".($_SESSION['userInfo']->gender)."</h1>"; 
         print "<h4> Your department: ".($_SESSION['userInfo']->department)."</h1>"; 
         print "<h4> Your status: ".($_SESSION['userInfo']->status)."</h1>"; 
         print "<h4> Your activation code: ".($_SESSION['userInfo']->code)."</h1>"; 
	


    $username = "joekeitho@yahoo.com";
    $stmt = $con->prepare("select * from UserRegistration");
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          //you can use function count($row) to get the total number of rows
      print '<tr>';
    print " username ".$row["UserName"]. "<br />";
    print " gender ".$row["UserGender"]. "<br />";
    print " password ".$row["UserPassword"]. "<br />";
    print " firstname ".$row["FirstName"]. "<br />";
      //now get the pictures related to this post
      //$sql = "select PicLink from POST_PIC where PostID = " . $row['PostId'];
      print "</td>";
      print "</tr>";

    }
//Header ("Location:Output.php?msg=".$message);
//Removed GET Message due to changing message to a session variable
Header ("Location:Output.php");
 ?>

	</body>
</html>
