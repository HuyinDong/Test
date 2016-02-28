<?php
$pagename='vl';

require_once("./db.php");

$limit=$_GET['limits'];

if($_REQUEST)
{
	$para = " and (  ( stitle like \"%$_REQUEST[keywords]%\") or    ( scve like \"%$_REQUEST[keywords]%\") or    ( svulnerable like \"%$_REQUEST[keywords]%\")  )";
}



$vul_sql = "select *
					from  smartexploits.securityfocus
			where 1=1 $para
						order by id desc
				limit $limit";

$vul_results  = mysql_query($vul_sql) or die("Query failed: " . mysql_error());

$total_sql = "select count(id) from   smartexploits.securityfocus   where 1=1 $para";

$total_results  = mysql_query($total_sql) or die("Query failed: " . mysql_error());

$total_row = mysql_fetch_array($total_results) ;
$sig_total = $total_row[0];

$sef = array();

if ($vul_results) {
    while ($row = mysql_fetch_object($vul_results)){
			$sef[] = $row;
		}
}


$data = array();

$data['data'] = $sef;
$data['total'] = $sig_total;
echo json_encode($data);


?>
