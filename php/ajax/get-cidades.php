<?php 
require "../config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$estado	= strtoupper($db->escape($_POST['estado']));
	$query 	= $db->get_results("SELECT id, nome FROM ".$tables['CIDADES']." WHERE uf='{$estado}'");
	
	if ($query)
	{
		echo '<option value="">Selecione a Cidade</option>';
		foreach($query as $result)
		{
			if($_POST["get_name"]=="1")
			{
				$VALUE = $result->nome;
			}else{
				$VALUE = $result->id;
			}
			
			echo '<option value="'.$VALUE.'" '.($result->id==$id_cidade?'selected="selected"':false).'>'.$result->nome.'</option>';		
		}
	}
} else header ('HTTP/1.1 404 Not Found');