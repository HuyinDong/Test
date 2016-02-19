<?php
require_once("../db.php");

$vendor = $_GET['vendor'];
$sql = "SELECT DISTINCT(prod_name) FROM `vendor` WHERE vendor_name = '".$vendor."'";
$results  = mysql_query($sql) or die("Query failed: " . mysql_error());

$products = array();
if ($results) {
    while ($row = mysql_fetch_array($results)) $products[] = $row['prod_name'];
}

//header('Content-type: application/json');
echo json_encode($products);

 ?>
