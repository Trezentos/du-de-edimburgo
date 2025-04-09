<?php

$__TABLE__ 	 = 'BANNERS';


# HEADERS
$_header['titulo'] 	= 'Banners';
$_header['icon'] 	= 'picture-o';



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

	// $rules[] = "required,titulo,Título";

	$errors = validateFields($_POST, $rules);




	$info_video = video_image(trim($_POST['video']));
	$video_code = $info_video['codigo'];




	# PREPARE DATA

	$array_data = [
		'titulo' 	 	=> $_POST['titulo'],
		'subtitulo' 	=> $_POST['subtitulo'],
		'status' 		=> $_POST['status'],
		'link' 	 		=> $_POST['link'],
		'destino_cta' 	=> $_POST['destino_cta'],
		'texto_cta' 	=> $_POST['texto_cta'],
		'video'  		=> $video_code,
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






	$extensao = "webp";

	if( $id )
	{
		require PHP.'classes/Class.imagem.php';

		
		# INSERT IMAGE
		$upload_temp = upload('imagem_desktop',TEMP,MAX_SIZE);
		
		if($upload_temp[0] == 'true')
		{
			$fileName 	 = $upload_temp[1];
			$fileNewName = 'banner-'.$id.'-'.rand(0,999);
            $width = 1920;
            $height = 1050;

			$image = new Image(TEMP.$fileName);
			$image->setPathToTempFiles(TEMP);
			$image->resize($width, $height, "crop", "c", "c", 90, "webp");
			$image->save(ROOT_UPLOADS_IMG.$fileNewName, "", "webp");

			$image->resize($width, $height, "crop", "c", "c", 90, "jpg");
			$image->save(ROOT_UPLOADS_IMG.$fileNewName, "", "jpg");
			
			$fileNewName = $fileNewName.'.'.$extensao;
			$db->update($tables[$__TABLE__], ['imagem_desktop' => $fileNewName], ['id'=>$id]);

			@unlink(TEMP.$fileName);
		}


		# INSERT IMAGE MOBILE
		$upload_temp = upload('imagem_mobile',TEMP,MAX_SIZE);
		
		if($upload_temp[0] == 'true')
		{
			$fileName 	  = $upload_temp[1];
			$fileNewName2 = 'banner-mobile-'.$id.'-'.rand(0,999);
            $width = 440;
            $height = 800;

			$image = new Image(TEMP.$fileName);
			
			$image->setPathToTempFiles(TEMP);
			$image->resize($width, $height, "crop", "c", "c",
            90, "webp");
			$image->save(ROOT_UPLOADS_IMG.$fileNewName2, "", "webp");

			$image->resize($width, $height, "crop", "c", "c",
            90, "jpg");
			$image->save(ROOT_UPLOADS_IMG.$fileNewName2, "", "jpg");
			
			$fileNewName2 = $fileNewName2.'.'.$extensao;
			$db->update($tables[$__TABLE__], ['imagem_mobile' => $fileNewName2], ['id'=>$id]);

			@unlink(TEMP.$fileName);
		}


		# DELETE IMAGE AND INSERT NEXT
		$_GET["del_img"] = 0;
	}
}






# DELETE IMAGE
if( $_GET["del_img"] == "1" && $_GET["imagem_desktop"] == "1" )
{
	deleteImg($id, $__TABLE__, "imagem_desktop", ROOT_UPLOADS_IMG);

	$db->update($tables[$__TABLE__], ['imagem_desktop' => NULL], ['id'=>$id]);
	
	$alertSuccess = true;
	$alertMessage = 'Imagem excluída com sucesso!';
}


# DELETE IMAGE MOBILE
if( $_GET["del_img"] == "1" && $_GET["imagem_mobile"] == "1" )
{
	deleteImg($id, $__TABLE__, "imagem_mobile", ROOT_UPLOADS_IMG);

	$db->update($tables[$__TABLE__], ['imagem_mobile' => NULL], ['id'=>$id]);
	
	$alertSuccess = true;
	$alertMessage = 'Imagem excluída com sucesso!';
}



# DELETE REG
if ($_REQUEST && isset($_REQUEST['delete']))
{
	deleteImg($id, $__TABLE__, "imagem_desktop", ROOT_UPLOADS_IMG);
	deleteImg($id, $__TABLE__, "imagem_mobile", ROOT_UPLOADS_IMG);

	$db->query("DELETE FROM ".$tables[$__TABLE__]." WHERE id='{$id}'");

	# REDIRECT
	header("Location: ".HTTP_GESTOR."list/".SELF_PAG."?del=ok");
}


# DELETE VIDEO
if ( $_GET["del_video"]=="1" )
{
	$db->update($tables[$__TABLE__], ['video'=> null], ['id'=>$id]);

	$_GET["del_video"] = 0;

	$alertSuccess = true;
	$alertMessage = 'Vídeo excluído com sucesso!';
}




if($id) {
	$q = $db->get_row("SELECT * FROM ".$tables[$__TABLE__]." WHERE id='{$id}'");
	if( $q->video ){ $url = "https://www.youtube.com/watch?v=".$q->video; }
}

if($_GET['del']=='ok'){
	$alertSuccess  = true;
	$alertMessage = 'Registro excluído com sucesso!';
}