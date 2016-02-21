<?php
require_once("../db.php");

$vendor = $_GET['vendor'];
$sql = "SELECT DISTINCT(vendor_name) FROM `vendor` WHERE vendor_name like '%".$vendor."%'";
$results  = mysql_query($sql) or die("Query failed: " . mysql_error());

$vendors = array();
if ($results) {
    while ($row = mysql_fetch_array($results)) $vendors[] = $row['vendor_name'];
}

//header('Content-type: application/json');
echo json_encode($vendors);

 ?>
