<?php
require __DIR__ . '/../config.php';
require GESTOR_MODELS . SELF_PAG;

// HEADERS
$_header['titulo'] = ($id?'Editar':'Novo').' Usuário';

get_header_gestor();
get_barra_header();
?>

<form name="form" id="form" action="" method="post" enctype="multipart/form-data" role="form">
	<div id="buttons">
		<div class="pull-left">
			<?
			btn_save();
			if ($galerias) btn_delete_form($id);
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
		<div class="row">
			<div class="form-group col-md-12">
				<label for="nome_completo">Nome completo</label>
				<input type="text" class="form-control input-sm" id="nome_completo" name="nome_completo" value="<?php echo ($galerias ? $galerias->nome_completo : $_POST['nome_completo']); ?>" require/>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-6">
				<label>E-mail</label>
				<input type="email" class="form-control input-sm" name="email" value="<?php echo ($galerias ? $galerias->email : $_POST['email']); ?>" require/>
			</div>
			<div class="form-group col-md-6">
				<label>Usuário</label>
				<input type="text" class="form-control input-sm" name="usuario" value="<?php echo ($galerias ? $galerias->usuario : $_POST['usuario']); ?>" require/>
			</div>
		</div>
		<div class="row">
			<?php if (!$galerias) { ?>
			<div class="form-group col-md-6">
				<label>Senha</label>
				<input type="password" class="form-control input-sm" name="senha" value="<?php echo ($galerias ? false : $_POST['senha']); ?>" require/>
			</div>
			<div class="form-group col-md-6">
				<label>Repetir senha</label>
				<input type="password" class="form-control input-sm" name="repetir-senha" value="<?php echo ($galerias ? false : $_POST['senha']); ?>" require/>
			</div>
			<?php } else if ($galerias) { ?>
			<div class="form-group col-md-6">
				<label for="senha">Nova senha</label>
				<input type="password" class="form-control input-sm" id="senha" name="senha" value="" />
				<p class="help-block"><small>Para alterar sua senha, digite a nova senha; caso contrário, deixe este espaço em branco.</small></p>
			</div>
			<div class="form-group col-md-6">
				<label for="confirmar-senha">Repetir nova senha</label>
				<input type="password" class="form-control input-sm" id="confirmar-senha" name="confirmar-senha" value="" />
				<p class="help-block"><small>Digite sua nova senha novamente.</small></p>
			</div>
			<?php } ?>
		</div>


		<div class="well">
			<h3 class="mt0"><i class="fa fa-key"></i> Permissões</h3>
			<div class="box-checkboxs">
				<?php 
				foreach($arMenu as $title => $var)
				{
					if ($var['access']!='FULL')
						if ($var['show']) {

				echo '<input id="'.$var['access'].'" name="acesso[]" value="'.$var['access'].'" type="checkbox" '.(in_array($var['access'], $acesso)?'checked':"").'/>
				<label class="fa" for="'.$var['access'].'"><span>'.$title.'</span></label>';

					}
				}
				?>
			</div>
		</div>


		<input type="hidden" name="id" value="<?php echo ($id?$id:false); ?>" />
		<input type="hidden" name="action" value="<?php echo ($id?'alterar':'adicionar'); ?>" />
	</fieldset>
</form>

<?php get_footer_gestor(); ?>