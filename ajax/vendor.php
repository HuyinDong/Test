<?php
$pagename='vl';

require_once("./db.php");
$limit = $_GET['limits'];
if ($_REQUEST[page] == null)
        $_REQUEST[page] = 1 ;

$page_limit  = 0 ;


if($_REQUEST)
{
		$page_limit = ( $_REQUEST[page] - 1 )* 100 ;
		$para = " and (  (vendor_name like \"%$_REQUEST[keywords]%\") or ( prod_name like \"%$_REQUEST[keywords]%\" ) )";
}

$vul_sql = "select vendor_id, vendor_name, prod_name, vers_num, edition
			from  smartexploits.vendor
			where 1=1 $para
			order by vendor_name,  prod_name, vers_num, edition
			limit $limit " ;

$vul_results  = mysql_query($vul_sql) or die("Query failed: " . mysql_error());

$total_sql = "select count(vendor_id) from   smartexploits.vendor   where 1=1 $para " ;

$total_results  = mysql_query($total_sql) or die("Query failed: " . mysql_error());

$total_row = mysql_fetch_array($total_results) ;
$sig_total = $total_row[0];

$data = array();
$vul = array();


if ($vul_results) {
    while ($row = mysql_fetch_object($vul_results))
    {
      $row->cvename = " ";
      $vul[] = $row;
    }
}
$data['data'] = $vul;
$data['total'] = $sig_total;

echo json_encode($data);


/*$vendor_sql = "select c.cve_id, c.cvename, c.severity
                  from  smartexploits.cve_vendor as m, smartexploits.CVEs as c
                  where m.vendor_id=". $row["vendor_id"]." and c.cve_id=m.cve_id" ;
                  echo $vendor_sql;
$vendor_results  = mysql_query($vendor_sql) or die("Query failed: " . mysql_error());
if ($vendor_results) {
    while ($row = mysql_fetch_object($vendor_results))
      $vendor_cves[] = $row;
    }*/
?>
