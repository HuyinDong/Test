<?php
$pagename='vl';

require_once("./db.php");

$limit=$_GET['limits'];

if($_REQUEST)
{
	$para = " and (  ( ctitle like \"%$_REQUEST[keywords]%\") or    ( cve like \"%$_REQUEST[keywords]%\") or    ( cid like \"%$_REQUEST[keywords]%\")  )";
}



$vul_sql = "select *
					from  smartexploits.cnvd
			where 1=1 $para
						order by id desc
				limit $limit";

$vul_results  = mysql_query($vul_sql) or die("Query failed: " . mysql_error());

$total_sql = "select count(id) from   smartexploits.cnvd   where 1=1 $para";

$total_results  = mysql_query($total_sql) or die("Query failed: " . mysql_error());

$total_row = mysql_fetch_array($total_results) ;
$sig_total = $total_row[0];

$cnvd = array();

if ($vul_results) {
    while ($row = mysql_fetch_object($vul_results)) $cnvd[] = $row;
}


$data = array();

$data['data'] = $cnvd;
$data['total'] = $sig_total;
echo json_encode($data);


?>
