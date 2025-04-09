<?php 

$__TABLE__ 	 	 = 'PAGINAS';


# HEADERS
$_header['titulo'] 	= 'Páginas';
$_header['icon'] 	= 'file-o';



# FOR LIST
$count = $db->get_var("SELECT COUNT(id) FROM ".$tables[$__TABLE__]);




# SET ID
if ($_POST['id']) {
	$id = $_POST['id'];
} else {
	$id = $_REQUEST['id'];
}

$id = $db->sanitize($id);






if($_POST && isset($_POST['submit']))
{

	# VALIDATION

	require PHP . "classes/Class.validacao.php";

	$rules[] = "required,titulo,Título";
	$rules[] = "required,permalink,Permalink";

	$errors = validateFields($_POST, $rules);




	# PREPARE DATA

	$array_data = [
		'titulo' 		=> $_POST['titulo'],
		'permalink' 	=> $_POST['permalink'],
		'arquivo' 		=> $_POST['arquivo'],
		'conteudo' 		=> $_POST['conteudo'],
		'description' 	=> $_POST['description'],
		'autor' 		=> $autor
	];



	switch($_POST['action'])
	{

		case 'adicionar':
		
			if (empty($errors))
			{
				
				$insert = $db->insert($tables[$__TABLE__], $array_data);
				
				//$db->debug();

				if($insert) {
					$alertSuccess = true;
					$alertMessage = 'Registro salvo com sucesso!';
					$id  		  = $db->lastInserId();
				} else {
					$alertFail 	  = true;
					$alertMessage = 'Não foi possível salvar o registro!';
				}
			}

		break;





		case 'alterar':
		
			if (empty($errors))
			{
				
				$db->update($tables[$__TABLE__], $array_data, ['id'=>$_POST['id']]);

				$alertSuccess = true;
				$alertMessage = 'Registro salvo com sucesso!';
			}

		break;		
	}
}





# DELETE REG
if ($_REQUEST && isset($_REQUEST['delete']))
{
	$db->query("DELETE FROM ".$tables[$__TABLE__]." WHERE id='{$id}'");

	# REDIRECT
	header("Location: ".HTTP_GESTOR."list/".SELF_PAG."?del=ok");
}


if($id) $query = $db->get_row("SELECT * FROM ".$tables[$__TABLE__]." WHERE id='{$id}'");


if($_GET['del']=='ok') {
	$alertSuccess  = true;
	$alertMessage = 'Registro excluído com sucesso!';
}