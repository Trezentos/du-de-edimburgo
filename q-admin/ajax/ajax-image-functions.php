<?php
require_once __DIR__.'/../config.php';

// GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if (!empty($_GET['id']) && !empty($_GET['action']) && !empty($_GET['tabela_img']) ) {

		$tabela = strtoupper($_GET['tabela_img']);

		switch($_GET['action']) {
			case 'ativa_desativa':
				$query = $db->get_row("SELECT * FROM ".$tables[$tabela]." WHERE id='{$_GET['id']}' LIMIT 1");

				if($query->ativo == 1) {
					$db->update($tables[$tabela], ['ativo'=>'0', 'capa'=>'0'], ['id'=>$_GET['id']]);
					$status = 'desativado';
				} else  {
					$db->update($tables[$tabela], ['ativo'=>'1'], ['id'=>$_GET['id']]);
					$status = 'ativado';				
				}
				echo json_encode(['error'=>'false', 'status'=>$status, 'id'=>$_GET['id']]);
			break;
			

			case 'set_capa':
				$query = $db->get_row("SELECT * FROM ".$tables[$tabela]." WHERE id='{$_GET['id']}' LIMIT 1");
				$db->update($tables[$tabela], ['capa'=>'0'], ['categoria'=>$query->categoria, 'id_galeria'=>$query->id_galeria]);
				$db->update($tables[$tabela], ['capa'=>'1','ativo'=>'1'], ['id'=>$_GET['id']]);
				echo json_encode(['error'=>'false','status'=>'setada','id'=>$_GET['id']]);
			break;
			

			case 'get_legenda':
				$query = $db->get_row("SELECT * FROM ".$tables[$tabela]." WHERE id='{$_GET['id']}' LIMIT 1");
				echo json_encode(['error'=>'false', 'legenda'=>''.$query->legenda.'']);
			break;


			case 'set_legenda':
				$db->update($tables[$tabela], ['legenda'=>$_GET['legenda']], ['id'=>$_GET['id_img'], 'id_galeria'=>$_GET['id']]);
				//$db->debug();
				if($_GET['legenda']) $status = 'setada';
				echo json_encode(['error'=>'false', 'status'=>$status, 'legenda'=>$_GET['legenda'], 'id_img'=>$_GET['id_img'], 'id'=>$_GET['id']]);
			break;
			

			case 'deletar':
				$query = $db->get_row("SELECT * FROM ".$tables[$tabela]." WHERE id='{$_GET['id']}' LIMIT 1");
				
				$ext = pathinfo($query->arquivo, PATHINFO_EXTENSION);

				if( $ext != "webp")
				{
					$arquivo_webp = altera_ext_webp($query->arquivo);

					@unlink(ROOT_UPLOADS_IMG.'tb-'.$arquivo_webp);
					@unlink(ROOT_UPLOADS_IMG.'md-'.$arquivo_webp);
					@unlink(ROOT_UPLOADS_IMG.'lg-'.$arquivo_webp);
				}

				@unlink(ROOT_UPLOADS_IMG.'tb-'.$query->arquivo);
				@unlink(ROOT_UPLOADS_IMG.'md-'.$query->arquivo);
				@unlink(ROOT_UPLOADS_IMG.'lg-'.$query->arquivo);
				@unlink(ROOT_UPLOADS_IMG.'vertical-tb-'.$query->arquivo);
				
				$db->query("DELETE FROM ".$tables[$tabela]." WHERE id='{$_GET['id']}'");
			break;	



			case 'rotate':

				require_once PHP.'classes/Class.imagem.php';

			    $query = $db->get_row("SELECT arquivo FROM ".$tables[$tabela]." WHERE id='{$_GET['id']}'");
			    
			    $ext 		= pathinfo($query->arquivo, PATHINFO_EXTENSION);
			    $nomeSemExt = pathinfo($query->arquivo, PATHINFO_FILENAME);

			    $aPrefix = ['tb-', 'md-', 'lg-'];

			    foreach ($aPrefix as $k => $v)
			    {
			    	if( file_exists( ROOT_UPLOADS_IMG.$v.$query->arquivo ) )
			    	{
				    	$img = new Image(ROOT_UPLOADS_IMG.$v.$query->arquivo);
				    	$img->rotate(90);
				    	$img->save(ROOT_UPLOADS_IMG.$v.$nomeSemExt);

			    		if( $ext != "webp") $img->save(ROOT_UPLOADS_IMG.$v.$nomeSemExt,"","webp");
			    	}
			    }

			    echo json_encode(['error'=>'false', 'file'=>HTTP_UPLOADS_IMG."tb-".$query->arquivo, 'id'=>$_GET['id']]);

			break;		
		}


	} else echo json_encode(['error'=>'true']);
	
// POST
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (!empty($_POST['action']) && !empty($_POST['tabela']) ) {

		$tabela = strtoupper($_POST['tabela']);

		switch($_POST['action']) {
			case 'ordenar':
				$newOrder = $_POST['data'];
				foreach($newOrder as $order) {
					list($id_imagem, $ordem) = explode("=", $order);
					$update = $db->query("UPDATE ".$tables[$tabela]." SET ordem = '".str_pad($ordem, 3, "0", STR_PAD_LEFT)."' WHERE id={$id_imagem}");
				}
				echo json_encode(['error'=>'false', 'status'=>'sucesso']);
				break;
			break;
		}

	} else echo json_encode(['error'=>'true']);
} else echo json_encode(['error'=>'true']);