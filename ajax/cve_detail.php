<?php
$pagename='vl';

require_once("./db.php");

$id = $_GET['cid'];
$cve_sql = "select *
			from  smartexploits.CVEs
			where cve_id=$id  " ;

$cve_results  = mysql_query($cve_sql) or die("Query failed: " . mysql_error());

$refs_sql = "select r.rtitle, r.rsource, r.rurl
			from  smartexploits.refs as r, smartexploits.cve_ref as m
			where m.cve_id=$id and r.ref_id=m.ref_id  " ;

$ref_results  = mysql_query($refs_sql) or die("Query failed: " . mysql_error());

$vendor_sql = "select v.vendor_name, v.prod_name, v.vers_num, v.edition
			from  smartexploits.vendor as v, smartexploits.cve_vendor as m
			where m.cve_id=$id  and v.vendor_id=m.vendor_id
			order by v.vendor_name,  v.prod_name, v.vers_num, v.edition" ;

$vendor_results  = mysql_query($vendor_sql) or die("Query failed: " . mysql_error());

$data = array();
$cves = array();
$refs = array();
$vendors = array();

if ($cve_results) {
    while ($row = mysql_fetch_object($cve_results)) $cves[] = $row;
}
if ($ref_results) {
    while ($row = mysql_fetch_object($ref_results)) $refs[] = $row;
}
if ($vendor_results) {
    while ($row = mysql_fetch_object($vendor_results)) $vendors[] = $row;
}
$data['cves'] = $cves;
$data['refs'] = $refs;
$data['vendors'] = $vendors;

echo json_encode($data);
?>
