<?php
require(__DIR__."/../config.php");

$data = date("d/m/Y");

header('Content-type: text; charset=utf-8');
header('Content-Disposition: attachment; filename=newsletter_'.$data.'.csv');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');

$WHERE = "WHERE 1=1 ";

if(!empty($_GET["di"]) && !empty($_GET["df"]))
{
	$_GET["di"] = formatDate( $_GET["di"] );
	$_GET["df"] = formatDate( $_GET["df"] );

	$WHERE .= " AND data_registro BETWEEN '{$_GET["di"]} 00:00:00' AND '{$_GET["df"]} 23:59:59'";
}

$query = $db->get_results("SELECT * FROM ".$tables['NEWSLETTER']." {$WHERE} GROUP BY email ORDER BY email ASC");

$i = 0;
foreach($query as $rs) {
	// $list[$i] = utf8_decode($rs->nome).";".$rs->email.";".$rs->tipo;
	$list[$i] = $rs->email;
	$i++;
}
print implode("\r\n",$list);