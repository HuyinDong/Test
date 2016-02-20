<?php

require_once("../db.php");

$cve = $_GET['cve'];

$cve_sql = "SELECT * FROM `CVEs` WHERE cvename ='".$cve."'";
$cve_results  = mysql_query($cve_sql) or die("Query failed: " . mysql_error());

$smartexploits_sql = "SELECT * FROM smartexploits where ereferences='".$cve."'";
$smartexploits_results  = mysql_query($smartexploits_sql) or die("Query failed: " . mysql_error());

$rapidexploits_sql = "SELECT * FROM rapidexploits where rreferences LIKE '%".$cve."%'";
$rapidexploits_results  = mysql_query($rapidexploits_sql) or die("Query failed: " . mysql_error());

$intelligentexploits_sql = "SELECT * FROM intelligentexploit where CVEs LIKE '%".$cve."%'";
$intelligentexploits_results  = mysql_query($intelligentexploits_sql) or die("Query failed: " . mysql_error());

$cves = array();
$smartexploits = array();
$rapidexploits = array();
$intelligentexploits = array();
$exploits = array();
$data = array();

if ($cve_results) {
    while ($row = mysql_fetch_object($cve_results)) $cves[] = $row;
}

if ($smartexploits_results) {
    while ($row = mysql_fetch_object($smartexploits_results)) $smartexploits[] = $row;
}

if ($rapidexploits_results) {
    while ($row = mysql_fetch_object($rapidexploits_results)) $rapidexploits[] = $row;
}

if ($intelligentexploits_results) {
    while ($row = mysql_fetch_object($intelligentexploits_results)) $intelligentexploits[] = $row;
}

$exploits["smartexploits"] = $smartexploits;
$exploits["rapidexploits"] = $rapidexploits;
$exploits["intelligentexploits"] = $intelligentexploits;
$data['cves'] = $cves;
$data['exploits'] = $exploits;

echo json_encode($data);

 ?>
