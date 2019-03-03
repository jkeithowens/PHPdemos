<?php session_start(); //this must be the very first line on the php page, to register this page to use session variables
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

}


    $stmt = $con->prepare("insert into UserRegistration values('test1','test2','test3','test4','test','test','test','test','test','test')");
    $stmt->execute();


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


 ?>

	</body>
</html>
