<?php
require_once __DIR__.'/../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
	if ( !empty($_GET['id']) && !empty($_GET['tabela']) )
	{
		$ID 		= $_GET['id'];
		$__TABLE__ 	= $_GET['tabela'];


		# CHECK IF EXIST FIELDS
		$existColumn1 = $db->query("SHOW COLUMNS FROM ".$tables[$__TABLE__]." LIKE 'imagem'");
		if( $existColumn1 ) deleteImg($ID, $__TABLE__, "imagem", ROOT_UPLOADS_IMG);


		$existColumn2 = $db->query("SHOW COLUMNS FROM ".$tables[$__TABLE__]." LIKE 'imagem_mobile'");
		if( $existColumn2 ) deleteImg($ID, $__TABLE__, "imagem_mobile", ROOT_UPLOADS_IMG);


		$existColumn3 = $db->query("SHOW COLUMNS FROM ".$tables[$__TABLE__]." LIKE 'arquivo'");
		if( $existColumn3 ) deleteFile($ID, $__TABLE__, "arquivo", ROOT_ARQUIVOS);


		# DELETE REGISTER
		$db->query("DELETE FROM ".$tables[$__TABLE__]." WHERE id='{$ID}'");


	} else echo json_encode(['error'=>'true']);

} else echo json_encode(['error'=>'true']);