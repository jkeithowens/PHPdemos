<!-- Author: J. Keith Owens
File Name: KeithTestDbConnect.php
Created Date: 10/15/2018
Purpose: connects to phpmyadmin database (corsair) used for registration page labs
				 Based on template provided in demo files for n342
JKO 10/15/2018 Original Build
-->

<?php
/**
 * This file defines PDO database package. This file is included in any files that needs database connection
 * http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers
 * http://php.net/manual/en/pdostatement.fetch.php
  */

/*** mysql hostname ***/
$hostname = 'localhost';

/*** mysql username ***/
$username = 'jkowens';

/*** mysql password ***/
$password = 'jkowens';

try {
    $con = new PDO("mysql:host=$hostname;dbname=jkowens_db", $username, $password);
    /*** echo a message saying we have connected ***/
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }

?>
