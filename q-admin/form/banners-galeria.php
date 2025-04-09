<?php 
require __DIR__ . '/../config.php';
require GESTOR_MODELS . SELF_PAG;
require_once GESTOR_CLASS . 'imageUploadComponent.php';


# HEADERS
$_header['titulo'] = ($id?'Editar':'Novo').' Banner Meio  - Home';


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
			<div class="form-group col-md-6">
				<? get_input_text('descricao', 'Descrição', $q->descricao) ?>
			</div> 

			<div class="form-group col-md-3">
				<? get_checkbox_switch('status', 'Status', $q->status); ?>
			</div>
		</div>

		<hr>

		<div class="row">
			<div class="form-group col-md-6">
				<div class="well">
					<?
					$imgUpload = new ImageUploadComponent('imagem_desktop', 'Imagem Desktop', $q->imagem_desktop);
					$imgUpload->setObs('A imagem deve ter 1280x570px.');
					$imgUpload->render();
					?>
				</div>
			</div>
		</div>


		<div class="row">
			<div class="form-group col-md-6">
				<div class="well">
					<?
					$imgUpload = new ImageUploadComponent('imagem_mobile', 'Imagem Mobile', $q->imagem_mobile);
					$imgUpload->setObs('A imagem deve ter 410x360px.');
					$imgUpload->render();
					?>
				</div>
			</div>
		</div>


		<input type="hidden" name="id" 	   value="<?php echo ($id?$id:false); ?>" />
		<input type="hidden" name="action" value="<?php echo ($id?'alterar':'adicionar'); ?>" />
	</fieldset>
</form>

<?php get_footer_gestor(); ?>