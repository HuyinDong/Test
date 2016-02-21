<?php

$pagename='vl';
$id = $_GET['vendor_id'];
require_once("./db.php");

$vendor_sql = "select c.cve_id, c.cvename, c.severity
                from  smartexploits.cve_vendor as m, smartexploits.CVEs as c
                  where m.vendor_id=".$id." and c.cve_id=m.cve_id" ;


$vendor_results  = mysql_query($vendor_sql) or die("Query failed: " . mysql_error());
if ($vendor_results) {
    while ($row = mysql_fetch_object($vendor_results))
      $vendors[] = $row;
    }
                  $data = array();
                  $data['data'] = $vendors;
                  echo json_encode($vendors);



 ?>
