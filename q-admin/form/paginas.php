<?php 
require __DIR__ . '/../config.php';
require GESTOR_MODELS . SELF_PAG;


# HEADERS
$_header['titulo'] = ($id?'Editar':'Nova').' Página';



get_header_gestor();
get_barra_header();
?>

<form name="form" id="form" action="" method="post" enctype="multipart/form-data" role="form">
	<div id="buttons">
		<div class="pull-left">
			<?php
			btn_save();
			if ($query) btn_delete_form($id);
			?>
		</div>
		<div class="pull-right">
			<?php
			btn_add();
			btn_back();
			?>
		</div>
	</div>

	<fieldset>
		<div class="row">
			<div class="form-group col-md-6">
				<label>Título</label>
				<input type="text" class="form-control input-sm" id="titulo" name="titulo" value="<?php echo ($query ? $query->titulo : $_POST['titulo']); ?>" required />
			</div>
			<div class="form-group col-md-6">
				<label>Permalink</label>
				<input type="text" class="form-control input-sm" id="permalink" name="permalink" value="<?php echo ($query ? $query->permalink : $_POST['permalink']); ?>" required />
			</div>
			<div class="form-group col-md-12">
				<label>Arquivo</label>
				<select class="form-control input-sm" name="arquivo">
					<option value="">Selecione</option>
					<?php get_templates(($query ? $query->arquivo : $_POST['arquivo'])); ?>
				</select>
			</div>
		</div>

		<!-- <div class="form-group">
			<label>Conteúdo</label>
			<textarea name="conteudo" class="tinymce-small"><?php echo stripslashes( ($query ? $query->conteudo : $_POST['conteudo']) ); ?></textarea>
		</div> -->
		
		<h3>Configurações de SEO</h3>

		<div class="form-group">
			<label>Description <small>(Máximo 160 caracteres)</small></label>
			<textarea class="form-control input-sm" name="description" maxlength="160"><?php echo ($query ? $query->description : $_POST['description']); ?></textarea>
		</div>

		<input type="hidden" name="id" value="<?php echo ($id?$id:false); ?>" />
		<input type="hidden" name="action" value="<?php echo ($id?'alterar':'adicionar'); ?>" />
		<input type="hidden" name="tabela" id="tabela" value="<?=$__TABLE__?>" />
	</fieldset>
</form>

<?php get_footer_gestor(); ?>