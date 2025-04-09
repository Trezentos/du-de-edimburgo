<?php 
require_once __DIR__.'/../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$estado	= strtoupper($db->escape($_POST['estado']));
	$query 	= $db->get_results("SELECT id, nome FROM ".$tables['CIDADES']." WHERE uf='{$estado}'");
	
	if ($query) {
		echo '<option value="">Selecione</option>';
		foreach($query as $result) echo '<option value="'.$result->id.'" '.($result->id==$id_cidade?'selected="selected"':false).'>'.$result->nome.'</option>';		
	}
} else header ('HTTP/1.1 404 Not Found');