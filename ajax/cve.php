<?php

$pagename='vl';

require_once("./db.php");
$limit = $_GET['limits'];
if($_REQUEST)
{
		$para = " and (  (cvename like \"%$_REQUEST[keywords]%\") or ( descript like \"%$_REQUEST[keywords]%\" ) )";
}

if($_REQUEST['n']=='y')
{
	$weekago = date('Y-m-d', strtotime('-7 days')) ;
	$para = $para . " and published > '$weekago'";
}

$vul_sql = "select cve_id, cvename, published, modified, severity, descript
			from  smartexploits.CVEs
			where 1=1   $para
			order by published desc
			limit   $limit  " ;//


$vul_results  = mysql_query($vul_sql) or die("Query failed: " . mysql_error());

$total_sql = "select count(cve_id) from   smartexploits.CVEs   where 1=1 $para " ;

$total_results  = mysql_query($total_sql) or die("Query failed: " . mysql_error());

$total_row = mysql_fetch_array($total_results) ;
$sig_total = $total_row[0];

$cves = array();
if ($vul_results) {
    while ($row = mysql_fetch_object($vul_results)) $cves[] = $row;
}
$data = array();

$data['data'] = $cves;
$data['total'] = $sig_total;
echo json_encode($data);
//echo json_encode($sig_total);

?>
