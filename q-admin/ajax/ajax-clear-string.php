<?php
require_once __DIR__.'/../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
	if(!empty($_GET['string']))
	{
		$newString = clean_string($_GET['string']);


		$existColumnTitulo = $db->query("SHOW COLUMNS FROM ".$tables[strtoupper($_GET['tabela'])]." LIKE 'titulo'");

		if( $existColumnTitulo )
		{
			$query = $db->get_var("SELECT COUNT(*) FROM ".$tables[strtoupper($_GET['tabela'])]." WHERE titulo = '{$_GET['string']}'");
		}
		else
		{
			$existColumn = $db->query("SHOW COLUMNS FROM ".$tables[strtoupper($_GET['tabela'])]." LIKE 'nome'");

			if( $existColumn )
			{
				$query = $db->get_var("SELECT COUNT(*) FROM ".$tables[strtoupper($_GET['tabela'])]." WHERE nome = '{$_GET['string']}'");
			}else{
				$query = $db->get_var("SELECT COUNT(*) FROM ".$tables[strtoupper($_GET['tabela'])]." WHERE descricao = '{$_GET['string']}'");
			}
		}

		if ($query > 0) {
			$newString = clean_string($_GET['string']).'-'.$query;
		}

		echo json_encode(['error'=>'false', 'string'=>$newString]);
	} else echo json_encode(['error'=>'true']);
} else echo json_encode(['error'=>'true']);