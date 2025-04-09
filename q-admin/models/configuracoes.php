<?php

$__TABLE__ = 'CONFIG';

if($_POST && isset($_POST['submit']))
{
	$array_update = [
		'nome_empresa' 				=> $_POST['nome_empresa'],
		'telefone'  				=> $_POST['telefone'],
		'celular'  					=> $_POST['celular'],
		'celular2'  				=> $_POST['celular2'],
		'email_contato'  			=> $_POST['email_contato'],

		'instagram'  				=> $_POST['instagram'],
		'facebook'  				=> $_POST['facebook'],
		'youtube'  					=> $_POST['youtube'],
		'twitter'  					=> $_POST['twitter'],
		'linkedin'  				=> $_POST['linkedin'],
		'behance'  					=> $_POST['behance'],

		'smtp_host'  				=> $_POST['smtp_host'],
		'smtp_port'  				=> $_POST['smtp_port'],
		'smtp_user'  				=> $_POST['smtp_user'],
		'smtp_pass'  				=> $_POST['smtp_pass'],
		'email_reply'  				=> $_POST['email_reply'],
		
		'google_analytics'  		=> $_POST['google_analytics'],
		'incorporar_head' 			=> $_POST['incorporar_head'],
		'incorporar_body' 			=> $_POST['incorporar_body'],

		'instagram_token' 			=> $_POST['instagram_token'],

		'texto_whatsapp' 			=> $_POST['texto_whatsapp'],
		'codigo_widget' 			=> $_POST['codigo_widget'],
	];

	$db->update($tables[$__TABLE__], $array_update, ['id'=>$_POST['id']]);

	$alertSuccess = true;
	$alertMessage = 'Registro salvo com sucesso!';
}


$id = 1;

$q = $db->get_row("SELECT * FROM ".$tables[$__TABLE__]." WHERE id='{$id}'");