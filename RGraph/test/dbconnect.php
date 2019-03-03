<?php
/**
 * This file defines database connection. This file is included in any files that needs database connection
 * 
  */


/*
$conn = mysql_connect("localhost", "linglu", "linglu") or die(mysql_error());
$select = mysql_select_db("linglu_db", $conn);
*/

/* Advantages for using the adodb5 abstract layer:
* Cleaner code
* Better speed
* Better exception handling
* Multiple database support, e.g. can connect to Oracle, MS SQL Server, MS Access, SQLite, PostgreSQL
* More details at http://adodb.sourceforge.net/
*/

include ("adodb5/adodb.inc.php");
include ("adodb5/adodb-exceptions.inc.php");

$DB = NewADOConnection("mysql");

$DB->Connect("localhost", "linglu", "linglu","linglu_db");

?>
