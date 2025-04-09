<?php 
require __DIR__ . '/../config.php';
require GESTOR_MODELS . SELF_PAG;
require_once GESTOR_CLASS . 'imageUploadComponent.php';


# HEADERS
$_header['titulo'] = ($id?'Editar':'Novo').' Banner - Home';


add_style([
	"css/lightbox.css",
]);

add_javascript([
	"jquery.tinymce.js",
	"script.textarea.js",
	"jquery.lightbox.min.js",
]);


get_header_gestor();
get_barra_header();
?>

<form name="form" id="form" action="" method="post" enctype="multipart/form-data" role="form">
	<div id="buttons">
		<div class="pull-left">
			<?
			btn_save();
			if ($q) btn_delete_form($id);
			?>
		</div>
		<div class="pull-right">
			<?
			btn_add();
			btn_back();
			?>
		</div>
	</div>

	<fieldset>
		<br>
		<div class="row">
			

		<br>
		<div class="row">
			

			<div class="form-group col-md-6">
				<label>Descrição *</label>
				<textarea name="titulo" class="tinymce-basic">
					<?=stripslashes( ($q ? $q->titulo : $_POST['titulo']) ); ?>
				</textarea>
			</div>
			<div class="form-group col-md-3">
				<? get_checkbox_switch('status', 'Status', $q->status); ?>
			</div>
		</div>
			<div class="form-group col-md-3">
				<? get_checkbox_switch('status', 'Status', $q->status); ?>
			</div>
		</div>

		
		<hr>


		<div class="well">
			<?
			$imgUpload = new ImageUploadComponent('imagem_desktop', 'Imagem Desktop', $q->imagem_desktop);
			$imgUpload->setObs('A imagem deve ter 1920x1050px.');
			$imgUpload->render();
			?>
		</div>


		<div class="row">
			<div class="form-group col-md-6">
				<div class="well">
					<?
					$imgUpload = new ImageUploadComponent('imagem_mobile', 'Imagem Mobile', $q->imagem_mobile);
					$imgUpload->setObs('A imagem deve ter 440x800px.');
					$imgUpload->render();
					?>
				</div>
			</div>
		</div>


		<hr>


		<div class="row">
			<div class="form-group col-md-12">
				<label>Link do Vídeo do YouTube</label>
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-link"></span></span>
					<input type="text" class="form-control input-sm" name="video" value="<?php echo ($url?$url:$_POST['video']);?>" />
				</div>
			</div>
		</div>

		<?php if($q->video){ ?>
			<br>
			<iframe width="1200" height="500" src="https://www.youtube.com/embed/<?php echo $q->video; ?>" frameborder="0" allowfullscreen></iframe>
			<br><br>

			<a class="btn btn-sm btn-danger deletar" href="<?=HTTP_GESTOR.'form/'.SELF_PAG;?>?id=<?php echo $id; ?>&del_video=1" title="Deletar" rel="tipsy"><span class="glyphicon glyphicon-trash"></span></a>

		<?php } ?>



		<input type="hidden" name="id" 	   value="<?php echo ($id?$id:false); ?>" />
		<input type="hidden" name="action" value="<?php echo ($id?'alterar':'adicionar'); ?>" />
	</fieldset>
</form>

<?php get_footer_gestor(); ?>