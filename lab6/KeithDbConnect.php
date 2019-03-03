<!-- Author: J. Keith Owens
File Name: KeithDbConnect.php
Created Date: 10/15/2018
Purpose: connects to phpmyadmin database (corsair) used for registration page labs
				 Based on template provided in demo files for n342
JKO 10/15/2018 Original Build
-->

<?php
/**
 * This file defines database connection. This file is included in any files that needs database connection
 *
  */

include ("adodb5/adodb.inc.php");
include ("adodb5/adodb-exceptions.inc.php");

$DB = NewADOConnection("mysql");

$DB->Connect("localhost", "jkowens", "jkowens","jkowens_db");

?>
