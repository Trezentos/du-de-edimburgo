<?php

$__TABLE__ 	 	 = 'GALERIA';
$__TABLE__IMG    = 'GALERIA_IMG';


# HEADERS
$_header['titulo'] = 'Galeria Geral';
$_header['icon']   = 'picture-o';


# FOR LIST
$count = $db->get_var("SELECT COUNT(*) FROM ".$tables[$__TABLE__]);





# SET ID
if ($_POST['id']) {
	$id = $_POST['id'];
} else {
	$id = $_REQUEST['id'];
}

 $id = $db->sanitize($id);
//$id = 1;

//


if ($_POST && isset($_POST['submit']))
{


	switch($_POST['action'])
	{

		case 'adicionar':

			require PHP."classes/Class.validacao.php";

			$rules[] = "required,titulo,Título";
			$rules[] = "required,permalink,Permalink";
			$rules[] = "required,status,Status";

			$errors = validateFields($_POST, $rules);

			if (empty($errors)) {
				$array_insert = [
					'titulo'		=> $_POST['titulo'],
					'permalink' 	=> $_POST['permalink'],
					'status' 		=> $_POST['status'],
				];

				$insert = $db->insert($tables[$__TABLE__], $array_insert);

				if($insert) {
					$alertSuccess 	= true;
					$alertMessage 	= 'Registro salvo com sucesso!';
					$id 			= $db->lastInserId();
				} else {
					$alertFail 		= true;
					$alertMessage 	= 'Não foi possível salvar o registro!';
				}
			}
		break;


		case 'alterar':
			require PHP."classes/Class.validacao.php";


			$rules[] = "required,titulo,Título";
			$rules[] = "required,permalink,Permalink";

			$errors = validateFields($_POST, $rules);

			if (empty($errors)) {
				$array_update = [
					'titulo'		=> $_POST['titulo'],
					'permalink' 	=> $_POST['permalink'],
					'status' 		=> $_POST['status'],
				];

				$db->update($tables[$__TABLE__], $array_update, ['id'=>$_POST['id']]);

				$alertSuccess 	= true;
				$alertMessage 	= 'Registro salvo com sucesso!';
			}
		break;
	}
}






if($id) {
	$q = $db->get_row("SELECT * FROM ".$tables[$__TABLE__]." WHERE id='{$id}'");

	$CAT_GAL = "galeria-$id";
}



// DELETAR REG
if ($_REQUEST && isset($_REQUEST['delete']))
{
	$query = $db->get_results("SELECT id, arquivo FROM ".$tables[$__TABLE__IMG]." WHERE id_galeria={$id}");
	
	// DELETANDO ARQUIVO
	foreach ($query AS $rs) {
		@unlink(ROOT_UPLOADS_IMG.'lg-'.$rs->arquivo);
		@unlink(ROOT_UPLOADS_IMG.'tb-'.$rs->arquivo);
	}
	
	$db->query("DELETE FROM ".$tables[$__TABLE__]." WHERE id='{$id}'");
	header("Location: ".HTTP_GESTOR."list/".SELF_PAG."?del=ok");
}


if($_GET['del']=='ok') {
	$alertSuccess  = true;
	$alertMessage = 'Registro excluído com sucesso!';
}