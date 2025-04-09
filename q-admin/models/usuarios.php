<?php 

$__TABLE__ 	 	 = 'USUARIOS';


# HEADERS
$_header['titulo'] 	= 'Usuários';
$_header['icon'] 	= 'user-o';



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

	$rules[] = "required,nome_completo,Nome completo";
	$rules[] = "required,usuario,Usuário";
	$rules[] = "required,email,E-mail";
	$rules[] = "valid_email,email,E-mail corretamente";
	if(count($_POST['acesso'])==0) $rules[] = "required,acesso,Nível de acesso";

	if($_POST['action'] == 'adicionar')
	{
		$rules[] = "required,senha,Senha";
		$rules[] = "required,repetir-senha,Repetir Senha";
	}

	$errors = validateFields($_POST, $rules);




	# PREPARE DATA

	$array_data = [
		'nome_completo'	=> $_POST['nome_completo'],
		'usuario'		=> $_POST['usuario'],
		'senha'			=> password_hash($_POST['senha'],PASSWORD_DEFAULT),
		'email'			=> $_POST['email'],
		'acesso'		=> implode("-",$_POST['acesso']),
		'autor'			=> $autor
	];




	switch($_POST['action'])
	{
	
		case 'adicionar':
		
			if (empty($errors))
			{
				if ($_POST['senha'] == $_POST['repetir-senha'])
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
				} else {
					$alertFail    = true;
					$alertMessage = 'Senhas incompatíveis, confira e tente novamente!';
				}
			}

		break;





		case 'alterar':

			if (empty($errors))
			{
				if ($_POST['senha'] == $_POST['confirmar-senha'])
				{
					$array_data = [
						'nome_completo'	=> $_POST['nome_completo'],
						'usuario'		=> $_POST['usuario'],
						'email'			=> $_POST['email'],
						'acesso'		=> implode("-",$_POST['acesso'])
					];
					
					if($_POST['senha']) $array_data['senha'] = password_hash($_POST['senha'],PASSWORD_DEFAULT);
					
					$db->update($tables[$__TABLE__], $array_data, ['id'=>$_POST['id']]);

					$alertSuccess = true;
					$alertMessage = 'Registro salvo com sucesso!';
				} else {
					$alertFail    = true;
					$alertMessage = 'Senhas incompatíveis, confira e tente novamente!';
				}
			}
		break;		
	}

}




if($id) {
	$query  = $db->get_row("SELECT * FROM ".$tables[$__TABLE__]." WHERE id='{$id}'");
	$acesso = explode("-",$query->acesso);
} else $acesso = [];




# DELETE
if ($_REQUEST && isset($_REQUEST['delete']))
{
	$db->query("DELETE FROM ".$tables[$__TABLE__]." WHERE id='{$_REQUEST['id']}'");

	# REDIRECT
	header("Location: ".HTTP_GESTOR."list/".SELF_PAG."?del=ok");
}


if($_GET['del']=='ok') {
	$alertSuccess = true;
	$alertMessage = 'Registro excluido com sucesso!';
}