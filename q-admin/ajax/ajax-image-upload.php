<?php
$formatos = ['png', 'jpg', 'jpeg', 'gif', 'webp'];

if (isset($_FILES['file']) && $_FILES['file']['error'] == 0)
{
	require_once __DIR__ . '/../config.php';


	$tempFile 		= $_FILES['file']['tmp_name'];
	$id 			= $db->escape($_POST['id']);
	$categoria 		= $_POST['categoria'];
	$tabela 		= strtoupper($_POST['tabela']);
	$tabela_img 	= strtoupper($_POST['tabela_img']);
	$TAM 			= 1920;
	$permalink 		= PREFIX_NAME_IMG;

	$permalink = $db->get_var("SELECT permalink FROM ".$tables[$tabela]." WHERE id='{$id}'");

	$upload_temp = upload('file',TEMP,MAX_SIZE);

	if($upload_temp[0] == 'true')
	{
		require PHP . 'classes/Class.imagem.php';


		$extensao = pathinfo($upload_temp[1], PATHINFO_EXTENSION);

		if( !in_array(strtolower($extensao), $formatos) ) {
			@unlink(TEMP.$upload_temp[1]);
			echo '{"status":"error"}';
			exit;
		}



		if ($extensao == 'jpeg') $extensao = "jpg";


		$fileName 	 = $upload_temp[1];
		$fileNewName = $permalink.'-'.$id.'-'.rand(0,999);

		list($width, $height) = getimagesize(TEMP.$fileName);

        $wTb  = 410;
        $hTb  = 360;


		if($height > $width) {
			$new_width	= $TAM;
			$new_height = ($TAM * $height)/$width;
		} else {
			$new_height	= ($height / $width) * $TAM;
			$new_width	= $TAM;
		}



		// LARGE - CREATE WEBP
		$image = new Image(TEMP.$fileName);
		$image->setPathToTempFiles(TEMP);
		$image->resize($new_width, $new_height, "fit", "c", "c", 80, "webp");
		$image->save(ROOT_UPLOADS_IMG.'lg-'.$fileNewName,"","webp");


		// SAVE JPG  FOR OLD BROWSER
		$image->resize($new_width, $new_height, "fit", "c", "c", 80, "jpg");
		$image->save(ROOT_UPLOADS_IMG.'lg-'.$fileNewName,"","jpg");


		// MED - CREATE WEBP
		$imgMd = new Image(TEMP.$fileName);
		$imgMd->setPathToTempFiles(TEMP);
		$imgMd->resize(647, 1000, "crop", "c", "c", 80, "webp");
		$imgMd->save(ROOT_UPLOADS_IMG.'md-'.$fileNewName,"","webp");


		// SAVE JPG / PNG FOR OLD BROWSER
		$imgMd->resize(647, 1000, "crop", "c", "c", 80, 'jpg');
		$imgMd->save(ROOT_UPLOADS_IMG.'md-'.$fileNewName, "", 'jpg'); 


		// THUMB - CREATE WEBP
		$imgTb = new Image(TEMP.$fileName);
		$imgTb->setPathToTempFiles(TEMP);
		$imgTb->resize(810, 500, "crop", "c", "c", 80, "webp");
		$imgTb->save(ROOT_UPLOADS_IMG.'tb-'.$fileNewName,"","webp");


		// SAVE JPG / PNG FOR OLD BROWSER
		$imgTb->resize(810, 500, "crop", "c", "c", 80, 'jpg');
		$imgTb->save(ROOT_UPLOADS_IMG.'tb-'.$fileNewName, '', 'jpg'); 


		$fileNewName = $fileNewName.".".$extensao;
		
		$db->insert($tables[$tabela_img], ['id_galeria'=>$id, 'arquivo'=>$fileNewName, 'categoria'=>$categoria]);
		$query = $db->get_row("SELECT id FROM ".$tables[$tabela_img]." WHERE arquivo='{$fileNewName}' LIMIT 1");
		@unlink(TEMP.$fileName);
				
		echo '{"status":"success", "id":"'.$query->id.'", "id_galeria":"'.$id.'", "nome":"'.$fileNewName.'", "categoria":"'.$categoria.'", "tabela":"'.strtolower($tabela).'", "tabela_img":"'.$tabela_img.'"}';
		exit;
	} else {
		@unlink(TEMP.$upload_temp[1]);
		echo '{"status":"error"}';
		exit;
	}
}

echo '{"status":"error"}';
exit;