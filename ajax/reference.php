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
		$para = " and (  ( rtitle like \"%$_REQUEST[keywords]%\") or  ( rsource like \"%$_REQUEST[keywords]%\")  or  ( rurl like \"%$_REQUEST[keywords]%\")  )";
}



$vul_sql = "select *
    	    from  smartexploits.refs
	    where 1=1 $para
            order by ref_id desc
   	    limit $limit" ;

$vul_results  = mysql_query($vul_sql) or die("Query failed: " . mysql_error());

$total_sql = "select count(ref_id) from   smartexploits.refs   where 1=1 $para " ;

$total_results  = mysql_query($total_sql) or die("Query failed: " . mysql_error());

$total_row = mysql_fetch_array($total_results) ;
$sig_total = $total_row[0];

$refs = array();
if ($vul_results) {
    while ($row = mysql_fetch_object($vul_results)) $refs[] = $row;
}
$data = array();

$data['data'] = $refs;
$data['total'] = $sig_total;
echo json_encode($data);

?>
