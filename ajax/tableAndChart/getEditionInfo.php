<?php
require_once("../db.php");

$vendor = $_GET['vendor'];
$product = $_GET['product'];
$version = $_GET['version'] == 'empty' ? " " : $_GET['version'];
$edition = $_GET['edition'] == 'empty' ? " " : $_GET['edition'];;
$cvename = $_GET['cvename'];

if($cvename != null){
  echo "cvename null";
}else if($edition != null){
  $sql = "SELECT DISTINCT(vendor_id) FROM `vendor` WHERE vendor_name = '".$vendor.
         "' and prod_name = '".$product."' and vers_num = '".$version."' and edition = '".$edition."'";
  $results  = mysql_query($sql) or die("Query failed: " . mysql_error());
  $row = mysql_fetch_array($results);
  $vendor_id = $row['vendor_id'];
  $sql = "select a.* from CVEs as a inner join cve_vendor b on a.cve_id = b.cve_id where b.vendor_id = ".$vendor_id;
    $results  = mysql_query($sql) or die("Query failed: " . mysql_error());
    $cves = array();
    if ($results) {
        while ($row = mysql_fetch_array($results)) $cves[] = $row['cvename'];
    }
    echo json_encode($cves);
}else{
  $sql = "SELECT DISTINCT(edition) FROM `vendor` WHERE vendor_name = '".$vendor.
         "' and prod_name = '".$product."' and vers_num = '".$version."'";
  $results  = mysql_query($sql) or die("Query failed: " . mysql_error());

  $editions = array();
  if ($results) {
      while ($row = mysql_fetch_array($results)) $editions[] = $row['edition'];
  }
  echo json_encode($editions);
}

 ?>
