<?php
$DBhost = "localhost";
$DBuser = "root";
$DBpass = "1986070@Dong";
$DBName = "smartexploits";

mysql_connect($DBhost,$DBuser,$DBpass) or die("Unable to connect to database" . mysql_error());

@mysql_select_db("$DBName") or die("Unable to select database $DBName" . mysql_error() );

$mysqli = new mysqli($DBhost, $DBuser, $DBpass, $DBName);
?>
