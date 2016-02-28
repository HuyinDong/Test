<?php

$pagename='vl';

require_once("./db.php");

//CVEs
$cve_total_sql = "select count(cve_id) from   smartexploits.CVEs" ;
$cve_total_results  = mysql_query($cve_total_sql) or die("Query failed: " . mysql_error());
$cve_total_row = mysql_fetch_array($cve_total_results) ;
$cve_sig_total = $cve_total_row[0];

//vendor
$vendor_total_sql = "select count(vendor_id) from   smartexploits.vendor" ;
$vendor_total_results  = mysql_query($vendor_total_sql) or die("Query failed: " . mysql_error());
$vendor_total_row = mysql_fetch_array($vendor_total_results) ;
$vendor_sig_total = $vendor_total_row[0];

//Ref
$ref_total_sql = "select count(ref_id) from   smartexploits.refs" ;
$ref_total_results  = mysql_query($ref_total_sql) or die("Query failed: " . mysql_error());
$ref_total_row = mysql_fetch_array($ref_total_results) ;
$ref_sig_total = $ref_total_row[0];

//sef
$sef_total_sql = "select count(id) from   smartexploits.securityfocus";
$sef_total_results  = mysql_query($sef_total_sql) or die("Query failed: " . mysql_error());
$sef_total_row = mysql_fetch_array($sef_total_results) ;
$sef_sig_total = $sef_total_row[0];

//meta
$meta_total_sql = "select count(id) from   smartexploits.rapidexploits" ;
$meta_total_results  = mysql_query($meta_total_sql) or die("Query failed: " . mysql_error());
$meta_total_row = mysql_fetch_array($meta_total_results) ;
$meta_sig_total = $meta_total_row[0];

//int
$int_total_sql = "select count(id) from   smartexploits.intelligentexploit" ;
$int_total_results  = mysql_query($int_total_sql) or die("Query failed: " . mysql_error());
$int_total_row = mysql_fetch_array($int_total_results) ;
$int_sig_total = $int_total_row[0];

//exp
$exp_total_sql = "select count(id) from   smartexploits" ;
$exp_total_results  = mysql_query($exp_total_sql) or die("Query failed: " . mysql_error());
$exp_total_row = mysql_fetch_array($exp_total_results) ;
$exp_sig_total = $exp_total_row[0];

//cnvd
$cnvd_total_sql = "select count(id) from   smartexploits.cnvd";
$cnvd_total_results  = mysql_query($cnvd_total_sql) or die("Query failed: " . mysql_error());
$cnvd_total_row = mysql_fetch_array($cnvd_total_results) ;
$cnvd_sig_total = $cnvd_total_row[0];


$data = array();

$data["MetaExploit"] = $meta_sig_total;
$data["IntExploit"] = $int_sig_total;
$data["SEF"] = $sef_sig_total;
$data["CNVD"] = $cnvd_sig_total;
$data["Vendor"] = $vendor_sig_total;
$data["Exploit"] = $exp_sig_total;
$data["CVE"] = $cve_sig_total;
$data["Ref"] = $ref_sig_total;

echo json_encode($data);
